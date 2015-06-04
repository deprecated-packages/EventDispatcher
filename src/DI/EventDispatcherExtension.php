<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Closure;
use Nette\DI\CompilerExtension;
use Nette\DI\ContainerBuilder;
use Nette\DI\Statement;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class EventDispatcherExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$containerBuilder = $this->getContainerBuilder();
		$services = $this->loadFromFile(__DIR__ . '/services.neon');
		$this->compiler->parseServices($containerBuilder, $services);
	}


	public function beforeCompile()
	{
		$containerBuilder = $this->getContainerBuilder();
		$containerBuilder->prepareClassList();

		$this->removeKdybySymfonyProxy();

		$eventDispatcher = $containerBuilder->getDefinition(
			$containerBuilder->getByType(EventDispatcherInterface::class)
		);

		foreach ($containerBuilder->findByType(EventSubscriberInterface::class) as $eventSubscriberDefinition) {
			$eventDispatcher->addSetup('addSubscriber', ['@' . $eventSubscriberDefinition->getClass()]);
		}

		$this->bindNetteEvents();
	}


	private function bindNetteEvents()
	{
		$containerBuilder = $this->getContainerBuilder();

		$netteEventList = (new NetteEventListFactory)->create();
		foreach ($netteEventList as $netteEvent) {
			if ( ! $serviceDefinitions = $containerBuilder->findByType($netteEvent->getClass())) {
				return;
			}

			foreach ($serviceDefinitions as $serviceDefinition) {
				$serviceDefinition->addSetup('$service->?[] = ?;', [
					$netteEvent->getProperty(),
					new Statement('
					function () {
						$class = ?;
						$event = new $class(...func_get_args());
						?->dispatch(?, $event);
					}', [
							$netteEvent->getEventClass(),
							'@' . EventDispatcherInterface::class,
							$netteEvent->getEventName()
						]
					)
				]);
			}
		}
	}


	private function removeKdybySymfonyProxy()
	{
		$containerBuilder = $this->getContainerBuilder();

		foreach ($containerBuilder->findByType(EventDispatcherInterface::class) as $name => $eventDispatcherDefinition)
		{
			if ($eventDispatcherDefinition->getFactory()->getEntity() === 'Kdyby\Events\SymfonyDispatcher') {
				// @bug workaround of https://github.com/nette/di/pull/71
				// also remove from definition class reference
				$classRemover = function (ContainerBuilder $containerBuilder, $name, $class) {
					if (isset($containerBuilder->classes[$class][TRUE])) {
						foreach ($containerBuilder->classes[$class][TRUE] as $key => $definitionName) {
							if ($name === $definitionName) {
								unset($containerBuilder->classes[$class][TRUE][$key]);
							}
						}
					}
				};
				$class = $containerBuilder->getDefinition($name)->getClass();
				$classRemover = Closure::bind($classRemover, NULL, $containerBuilder);
				$classRemover($containerBuilder, $name, $class);

				$containerBuilder->removeDefinition($name);
			}
		}
	}

}
