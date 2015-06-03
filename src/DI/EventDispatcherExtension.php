<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Closure;
use Nette\Application\Application;
use Nette\DI\CompilerExtension;
use Nette\DI\ContainerBuilder;
use Nette\DI\Statement;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Event\ApplicationEvent;
use Symnedi\EventDispatcher\Event\ApplicationRequestEvent;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;


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

		$eventDispatcher = $containerBuilder->getDefinition(
			$containerBuilder->getByType(EventDispatcherInterface::class)
		);

		foreach ($containerBuilder->findByType(EventSubscriberInterface::class) as $eventSubscriberDefinition) {
			$eventDispatcher->addSetup('addSubscriber', ['@' . $eventSubscriberDefinition->getClass()]);
		}

		$this->removeKdybySymfonyProxy();
		$this->bindNetteEvents();
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


	private function bindNetteEvents()
	{
		$containerBuilder = $this->getContainerBuilder();

		$netteEvents = [
			ApplicationEvents::ON_APPLICATION_REQUEST => [
				'class' => Application::class,
				'property' => 'onRequest',
				'eventClass' => ApplicationRequestEvent::class,
				'eventName' => ApplicationEvents::ON_APPLICATION_REQUEST,
			],
			ApplicationEvents::ON_STARTUP => [
				'class' => Application::class,
				'property' => 'onStartup',
				'eventClass' => ApplicationEvent::class,
				'eventName' => ApplicationEvents::ON_STARTUP,
			]
			// todo: complete
		];

		foreach ($netteEvents as $netteEvent) {
			if ( ! $definitionName = $containerBuilder->getByType($netteEvent['class'])) {
				return;
			}

			$serviceDefinition = $containerBuilder->getDefinition($definitionName);
			$serviceDefinition->addSetup('$service->?[] = ?;', [
				$netteEvent['property'],
				new Statement('
				function () {
					$class = ?;
			        $event = new $class(...func_get_args());
			        ?->dispatch(?, $event);
			    }', [
						$netteEvent['eventClass'],
						'@' . EventDispatcherInterface::class,
						$netteEvent['eventName']
					]
				)
			]);
		}
	}

}
