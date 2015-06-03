<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Exception;
use Nette\Application\Application;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
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


	public function testGetListeners()
	{
		$this->assertCount(3, $this->eventDispatcher->getListeners());
		$this->assertCount(1, $this->eventDispatcher->getListeners('subscriber.event'));
		$this->assertCount(1, $this->eventDispatcher->getListeners(ApplicationEvents::ON_APPLICATION_REQUEST));
		$this->assertCount(1, $this->eventDispatcher->getListeners(ApplicationEvents::ON_STARTUP));
	}


	public function testDispatchAllEvents()
	{
		$this->application->run();
		$this->assertSame('OK', $this->eventStateStorage->getEventState(ApplicationEvents::ON_STARTUP));
		$this->assertSame('OK', $this->eventStateStorage->getEventState(ApplicationEvents::ON_APPLICATION_REQUEST));
	}

}
