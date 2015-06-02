<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Exception;
use Nette\Application\Application;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


class NetteEventDispatchTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcher;

	/**
	 * @var Application
	 */
	private $application;


	protected function setUp()
	{
		$containerFactory = (new ContainerFactory)->create();
		$this->eventDispatcher = $containerFactory->getByType(EventDispatcherInterface::class);
		$this->application = $containerFactory->getByType(Application::class);
	}


	public function testGetListeners()
	{
		$this->assertCount(2, $this->eventDispatcher->getListeners());
		$this->assertCount(1, $this->eventDispatcher->getListeners('subscriber.event'));
		$this->assertCount(1, $this->eventDispatcher->getListeners(ApplicationEvents::ON_APPLICATION_REQUEST));
	}


	public function testDispatch()
	{
		$this->setExpectedException(Exception::class);
		$this->eventDispatcher->dispatch(ApplicationEvents::ON_APPLICATION_REQUEST);
	}


	public function testApplicationRun()
	{
		$this->setExpectedException(Exception::class);
		$this->application->run();
	}

}
