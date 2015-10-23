<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Statement;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Bridge\KdybyEvents\DI\KdybyDispatcherRemover;


final class EventDispatcherExtension extends CompilerExtension
{

	/**
	 * {@inheritdoc}
	 */
	public function loadConfiguration()
	{
		$containerBuilder = $this->getContainerBuilder();
		$services = $this->loadFromFile(__DIR__ . '/services.neon');
		$this->compiler->parseServices($containerBuilder, $services);
	}


	/**
	 * {@inheritdoc}
	 */
	public function beforeCompile()
	{
		$containerBuilder = $this->getContainerBuilder();
		$containerBuilder->prepareClassList();

		$this->removeKdybyEventsSymfonyDispatcherProxy();

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


	private function removeKdybyEventsSymfonyDispatcherProxy()
	{
		$containerBuilder = $this->getContainerBuilder();
		if ( ! $this->compiler->getExtensions('Kdyby\Events\DI\EventsExtension')) {
			return;
		}

		(new KdybyDispatcherRemover)->removeFromContainer($containerBuilder);
	}

}
