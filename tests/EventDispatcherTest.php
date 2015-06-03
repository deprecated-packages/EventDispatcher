<?php

namespace Symnedi\EventDispatcher\Tests;

use Exception;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class EventDispatcherTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcher;


	protected function setUp()
	{
		$container = (new ContainerFactory)->create();
		$this->eventDispatcher = $container->getByType(EventDispatcherInterface::class);
	}


	public function testDispatchSubscriber()
	{
		$this->setExpectedException(Exception::class, 'Event was dispatched in subscriber.');
		$this->eventDispatcher->dispatch('subscriber.event');
	}

}
