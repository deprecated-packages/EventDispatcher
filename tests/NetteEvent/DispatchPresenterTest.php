<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Nette\Application\Application;
use PHPUnit_Framework_TestCase;
use Symnedi\EventDispatcher\NettePresenterEvents;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


class DispatchPresenterTest extends PHPUnit_Framework_TestCase
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


	public function testDispatch()
	{
		$this->application->run();
		$this->assertSame('OK', $this->eventStateStorage->getEventState(NettePresenterEvents::ON_SHUTDOWN));
	}

}
