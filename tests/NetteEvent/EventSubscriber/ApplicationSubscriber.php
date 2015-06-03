<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Event\ApplicationEvent;
use Symnedi\EventDispatcher\Event\ApplicationExceptionEvent;
use Symnedi\EventDispatcher\Event\ApplicationPresenterEvent;
use Symnedi\EventDispatcher\Event\ApplicationRequestEvent;
use Symnedi\EventDispatcher\Event\ApplicationResponseEvent;
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


	public function onRequest(ApplicationRequestEvent $applicationRequestEvent)
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_REQUEST, $applicationRequestEvent);
	}


	public function onStartup(ApplicationEvent $applicationEvent)
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_STARTUP, $applicationEvent);
	}


	public function onPresenter(ApplicationPresenterEvent $applicationPresenterEvent)
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_PRESENTER, $applicationPresenterEvent);
	}


	public function onShutdown(ApplicationExceptionEvent $applicationExceptionEvent)
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_SHUTDOWN, $applicationExceptionEvent);
	}


	public function onError(ApplicationExceptionEvent $applicationExceptionEvent)
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_ERROR, $applicationExceptionEvent);
	}


	public function onResponse(ApplicationResponseEvent $applicationResponseEvent)
	{
		$this->eventStateStorage->addEventState(NetteApplicationEvents::ON_RESPONSE, $applicationResponseEvent);
	}

}
