<?php

/**
 * This file is part of EventDispatcher
 *
 * Copyright (c) 2014 Pears Health Cyber, s.r.o. (http://pearshealthcyber.cz)
 *
 * For the full copyright and license information, please view
 * the file license.md that was distributed with this source code.
 */

namespace Symnedi\EventDispatcher\Tests;

use Exception;
use Nette\DI\Container;
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
