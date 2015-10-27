<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use Nette\DI\Statement;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Contract\DI\NetteEventItemInterface;


final class EventDispatcherExtension extends CompilerExtension
{

	/**
	 * {@inheritdoc}
	 */
	public function loadConfiguration()
	{
		if ($this->isKdybyEventsRegistered()) {
			return;
		}

		$containerBuilder = $this->getContainerBuilder();
		$containerBuilder->addDefinition($this->prefix('eventDispatcher'))
			->setClass(EventDispatcher::class);
	}


	/**
	 * {@inheritdoc}
	 */
	public function beforeCompile()
	{
		$containerBuilder = $this->getContainerBuilder();
		$containerBuilder->prepareClassList();

		$eventDispatcher = $this->getDefinitionByType(EventDispatcherInterface::class);

		if ($this->isKdybyEventsRegistered()) {
			$eventDispatcher->setClass(EventDispatcher::class)
				->setFactory(NULL);
		}

		$this->addSubscribersToEventDispatcher();
		$this->bindNetteEvents();
		$this->bindEventDispatcherToSymfonyConsole();
	}


	/**
	 * @return bool
	 */
	private function isKdybyEventsRegistered()
	{
		return (bool) $this->compiler->getExtensions('Kdyby\Events\DI\EventsExtension');
	}


	private function addSubscribersToEventDispatcher()
	{
		$containerBuilder = $this->getContainerBuilder();
		$eventDispatcher = $this->getDefinitionByType(EventDispatcherInterface::class);

		foreach ($containerBuilder->findByType(EventSubscriberInterface::class) as $eventSubscriberDefinition) {
			$eventDispatcher->addSetup('addSubscriber', ['@' . $eventSubscriberDefinition->getClass()]);
		}
	}


	/**
	 * @param string $type
	 * @return ServiceDefinition
	 */
	private function getDefinitionByType($type)
	{
		$containerBuilder = $this->getContainerBuilder();
		$definitionName = $containerBuilder->getByType($type);
		return $containerBuilder->getDefinition($definitionName);
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
				$this->decorateServiceDefinitionWithNetteEvent($serviceDefinition, $netteEvent);
			}
		}
	}


	private function decorateServiceDefinitionWithNetteEvent(
		ServiceDefinition $serviceDefinition,
		NetteEventItemInterface $netteEvent
	) {
		$propertyStatement = new Statement('function () {
			$class = ?;
			$event = new $class(...func_get_args());
			?->dispatch(?, $event);
		}', [$netteEvent->getEventClass(), '@' . EventDispatcherInterface::class, $netteEvent->getEventName()]);

		$serviceDefinition->addSetup('$service->?[] = ?;', [$netteEvent->getProperty(), $propertyStatement]);
	}


	private function bindEventDispatcherToSymfonyConsole()
	{
		$containerBuilder = $this->getContainerBuilder();
		if ($consoleApplicationName = $containerBuilder->getByType('Symfony\Component\Console\Application')) {
			$consoleApplicationDefinition = $containerBuilder->getDefinition($consoleApplicationName);
			$consoleApplicationDefinition->addSetup('setDispatcher');
		}
	}

}
