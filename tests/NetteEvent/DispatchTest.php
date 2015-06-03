<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Nette\Application\Application;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\NetteApplicationEvents;
use Symnedi\EventDispatcher\NettePresenterEvents;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


class DispatchTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcher;

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
		$this->eventDispatcher = $containerFactory->getByType(EventDispatcherInterface::class);
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


	public function testDispatchNetteApplicationEventsWithError()
	{
		$this->application->run();
//		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_RESPONSE));
//		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_ERROR));
	}


	public function testDispatchNettePresenterEvents()
	{
		$this->application->run();
		$this->assertSame('OK', $this->eventStateStorage->getEventState(NettePresenterEvents::ON_SHUTDOWN));
	}

}
