<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Mockery;
use Nette\Application\Application;
use Nette\Application\Request;
use PHPUnit_Framework_TestCase;
use Symnedi\EventDispatcher\NetteApplicationEvents;
use Symnedi\EventDispatcher\Tests\ContainerFactory;


class DispatchApplicationEventResponseTest extends PHPUnit_Framework_TestCase
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
		$this->assertFalse($this->eventStateStorage->getEventState(NetteApplicationEvents::ON_RESPONSE));

		$requestMock = Mockery::mock(Request::class, [
			'getPresenterName' => 'Response',
			'getParameters' => [],
			'getPost' => NULL,
			'isMethod' => TRUE
		]);
		$this->application->processRequest($requestMock);

		$this->assertSame('OK', $this->eventStateStorage->getEventState(NetteApplicationEvents::ON_RESPONSE));
	}

}
