<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Exception;
use Nette\Application\Application;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
use Symnedi\EventDispatcher\Nette\PresenterEvents;
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


	public function testDispatchApplicationEvents()
	{
		$this->application->run();
		$this->assertSame('OK', $this->eventStateStorage->getEventState(ApplicationEvents::ON_APPLICATION_REQUEST));
		$this->assertSame('OK', $this->eventStateStorage->getEventState(ApplicationEvents::ON_STARTUP));
		$this->assertSame('OK', $this->eventStateStorage->getEventState(ApplicationEvents::ON_PRESENTER));
	}


	public function testDispatchPresenterEvents()
	{
		$this->application->run();
		$this->assertSame('OK', $this->eventStateStorage->getEventState(PresenterEvents::ON_SHUTDOWN));
	}

}
