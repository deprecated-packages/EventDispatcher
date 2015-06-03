<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\NettePresenterEvents;
use Symnedi\EventDispatcher\Tests\NetteEvent\EventStateStorage;


class PresenterSubscriber implements EventSubscriberInterface
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
			NettePresenterEvents::ON_SHUTDOWN => 'onShutdown'
		];
	}


	public function onShutdown()
	{
		$this->eventStateStorage->addEventState(NettePresenterEvents::ON_SHUTDOWN, 'OK');
	}

}
