<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\NetteApplicationEvents;
use Symnedi\EventDispatcher\Tests\NetteEvent\EventStateStorage;


class ApplicationSubscriber implements EventSubscriberInterface
{

	/**
	 * @var EventStateStorage
	 */
	private $eventStateStorage;


	public function __construct(EventStateStorage $eventStateStorage)
	{
		$this->eventStateStorage = $eventStateStorage;
	}


	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return [
			NetteApplicationEvents::ON_REQUEST => 'onRequest',
			NetteApplicationEvents::ON_STARTUP => 'onStartup',
			NetteApplicationEvents::ON_PRESENTER => 'onPresenter',
			NetteApplicationEvents::ON_SHUTDOWN => 'onShutdown',
			NetteApplicationEvents::ON_RESPONSE => 'onResponse',
			NetteApplicationEvents::ON_ERROR => 'onError'
		];
	}


	public function onRequest()
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_REQUEST, 'OK');
	}


	public function onStartup()
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_STARTUP, 'OK');
	}


	public function onPresenter()
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_PRESENTER, 'OK');
	}


	public function onShutdown()
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_SHUTDOWN, 'OK');
	}


	public function onError()
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_ERROR, 'OK');
	}


	public function onResponse()
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_RESPONSE, 'OK');
	}

}
