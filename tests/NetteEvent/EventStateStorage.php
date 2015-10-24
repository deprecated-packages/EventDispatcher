<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;

use Symnedi\EventDispatcher\Event\AbstractEvent;


class EventStateStorage
{

	/**
	 * @var string[]
	 */
	private $storage;


	/**
	 * @param string $event
	 * @param AbstractEvent $state
	 */
	public function addEventState($event, AbstractEvent $state)
	{
		$this->storage[$event] = $state;
	}


	/**
	 * @param string $event
	 * @return AbstractEvent
	 */
	public function getEventState($event)
	{
		if (isset($this->storage[$event])) {
			return $this->storage[$event];
		}
		return FALSE;
	}

}
