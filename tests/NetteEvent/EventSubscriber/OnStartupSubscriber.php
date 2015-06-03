<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
use Symnedi\EventDispatcher\Tests\NetteEvent\EventStateStorage;


class OnStartupSubscriber implements EventSubscriberInterface
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
		return [ApplicationEvents::ON_STARTUP => 'onStartup'];
	}


	public function onStartup()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_STARTUP, 'OK');
	}

}
