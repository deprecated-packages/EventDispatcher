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
			ApplicationEvents::ON_APPLICATION_REQUEST => 'onRequest',
			ApplicationEvents::ON_STARTUP => 'onStartup',
			ApplicationEvents::ON_PRESENTER => 'onPresenter'
		];
	}


	public function onRequest()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_APPLICATION_REQUEST, 'OK');
	}


	public function onStartup()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_STARTUP, 'OK');
	}


	public function onPresenter()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_PRESENTER, 'OK');
	}

}
