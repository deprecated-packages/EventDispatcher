<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\EventSubscriber;

use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
use Symnedi\EventDispatcher\Tests\NetteEvent\EventStateStorage;


class OnRequestSubscriber implements EventSubscriberInterface
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
		return [ApplicationEvents::ON_APPLICATION_REQUEST => 'onRequest'];
	}


	public function onRequest()
	{
		$this->eventStateStorage->addEventState(ApplicationEvents::ON_APPLICATION_REQUEST, 'OK');
	}

}
