<?php

namespace Symnedi\EventDispatcher\Tests\Bridge\KdybyEvents\DI;

use Kdyby\Events\SymfonyDispatcher;
use Nette\DI\ContainerBuilder;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\Bridge\KdybyEvents\DI\KdybyDispatcherRemover;


final class KdybyDispatcherRemoverTest extends PHPUnit_Framework_TestCase
{

	public function testRemove()
	{
		$containerBuilder = new ContainerBuilder;
		$this->assertCount(0, $containerBuilder->getDefinitions());

		/**
		 * code from @see Kdyby\Events\DI\EventsExtension::loadConfiguration()
		 */
		$containerBuilder->addDefinition('kdyby.events.symfonyProxy')
			->setClass(EventDispatcherInterface::class)
			->setFactory(SymfonyDispatcher::class);

		$containerBuilder->addDefinition('symfony.eventDispatcher')
			->setClass(EventDispatcher::class);

		$kdybyDispatcherRemover = new KdybyDispatcherRemover;
		$kdybyDispatcherRemover->removeFromContainer($containerBuilder);

		$this->assertCount(2, $containerBuilder->getDefinitions());
	}

}
