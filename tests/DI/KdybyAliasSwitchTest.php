<?php

namespace Symnedi\EventDispatcher\Tests\DI;

use Kdyby\Events\EventManager;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


final class KdybyAliasSwitchTest extends PHPUnit_Framework_TestCase
{

	public function test()
	{
		$container = (new ContainerFactory)->createWithConfig(__DIR__ . '/../config/aliasSwitch.neon');
		$eventDispatcher = $container->getByType(EventDispatcherInterface::class);
		$this->assertInstanceOf(EventDispatcherInterface::class, $eventDispatcher);
		$this->assertNotInstanceOf(EventManager::class, $eventDispatcher);
	}

}
