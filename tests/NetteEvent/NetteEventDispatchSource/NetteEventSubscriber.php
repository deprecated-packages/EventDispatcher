<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\NetteEventDispatchSource;

use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;


class NetteEventSubscriber implements EventSubscriberInterface
{

	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return [ApplicationEvents::ON_APPLICATION_REQUEST => 'onRequest'];
	}


	public function onRequest()
	{
		throw new Exception('Event was dispatched in subscriber.');
	}

}
