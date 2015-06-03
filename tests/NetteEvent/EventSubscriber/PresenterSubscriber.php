<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
use Symnedi\EventDispatcher\Nette\PresenterEvents;
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
			PresenterEvents::ON_SHUTDOWN => 'onShutdown'
		];
	}


	public function onShutdown()
	{
		$this->eventStateStorage->addEventState(PresenterEvents::ON_SHUTDOWN, 'OK');
	}

}
