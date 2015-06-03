<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Nette\Application\Application;
use PHPUnit_Framework_TestCase;
use Symnedi\EventDispatcher\NetteApplicationEvents;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


class DispatchApplicationTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Application
	 */
	private $application;

	/**
	 * @var EventStateStorage
	 */
	private $eventStateStorage;


	protected function setUp()
	{
		$containerFactory = (new ContainerFactory)->create();
		$this->application = $containerFactory->getByType(Application::class);
		$this->eventStateStorage = $containerFactory->getByType(EventStateStorage::class);
	}


	public function testDispatchNetteApplicationEvents()
	{
		$this->application->run();
		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_REQUEST));
		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_STARTUP));
		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_PRESENTER));
		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_SHUTDOWN));
	}

}
