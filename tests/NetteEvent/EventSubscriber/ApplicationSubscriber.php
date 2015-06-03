<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
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
			ApplicationEvents::ON_REQUEST => 'onRequest',
			ApplicationEvents::ON_STARTUP => 'onStartup',
			ApplicationEvents::ON_PRESENTER => 'onPresenter',
			ApplicationEvents::ON_SHUTDOWN => 'onShutdown',
			ApplicationEvents::ON_RESPONSE => 'onResponse',
			ApplicationEvents::ON_ERROR => 'onError'
		];
	}


	public function onRequest()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_REQUEST, 'OK');
	}


	public function onStartup()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_STARTUP, 'OK');
	}


	public function onPresenter()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_PRESENTER, 'OK');
	}


	public function onShutdown()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_SHUTDOWN, 'OK');
	}


	public function onError()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_ERROR, 'OK');
	}


	public function onResponse()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_RESPONSE, 'OK');
	}

}
