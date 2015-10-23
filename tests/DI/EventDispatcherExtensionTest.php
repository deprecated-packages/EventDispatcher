<?php

namespace Symnedi\EventDispatcher\Tests\DI;

use Nette\DI\Compiler;
use Nette\DI\ContainerBuilder;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\DI\EventDispatcherExtension;
use Symnedi\EventDispatcher\Tests\DI\EventDispatcherExtensionSource\SomeEventSubscriber;


final class EventDispatcherExtensionTest extends PHPUnit_Framework_TestCase
{

	public function testGetEventDispatcher()
	{
		$extension = $this->getExtension();
		$extension->loadConfiguration();

		$containerBuilder = $extension->getContainerBuilder();
		$containerBuilder->prepareClassList();

		$eventDispatcherDefinition = $containerBuilder->getDefinition(
			$containerBuilder->getByType(EventDispatcherInterface::class)
		);
		$this->assertSame(EventDispatcher::class, $eventDispatcherDefinition->getClass());
	}


	public function testLoadSubscribers()
	{
		$extension = $this->getExtension();
		$containerBuilder = $extension->getContainerBuilder();

		$extension->loadConfiguration();

		$containerBuilder->addDefinition('eventSubscriber')
			->setClass(SomeEventSubscriber::class);

		$extension->beforeCompile();

		$eventDispatcherDefinition = $containerBuilder->getDefinition(
			$containerBuilder->getByType(EventDispatcherInterface::class)
		);

		$this->assertCount(1, $eventDispatcherDefinition->getSetup());
	}


	/**
	 * @return EventDispatcherExtension
	 */
	private function getExtension()
	{
		$extension = new EventDispatcherExtension;
		$extension->setCompiler(new Compiler(new ContainerBuilder), 'events');
		return $extension;
	}

}
