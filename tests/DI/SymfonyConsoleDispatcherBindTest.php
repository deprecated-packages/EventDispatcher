<?php

namespace Symnedi\EventDispatcher\Tests\DI;

use PHPUnit_Framework_Assert;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


final class SymfonyConsoleDispatcherBindTest extends PHPUnit_Framework_TestCase
{

	public function test()
	{
		$container = (new ContainerFactory)->createWithConfig(__DIR__ . '/../config/aliasSwitch.neon');

		/** @var Application $application */
		$application = $container->getByType(Application::class);
		$this->assertInstanceOf(Application::class, $application);

		$eventDispatcher = PHPUnit_Framework_Assert::getObjectAttribute($application, 'dispatcher');
		$this->assertInstanceOf(EventDispatcherInterface::class, $eventDispatcher);
	}

}
