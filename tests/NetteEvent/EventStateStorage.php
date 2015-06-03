<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent;


class EventStateStorage
{

	/**
	 * @var string[]
	 */
	private $storage;


	/**
	 * @param string $event
	 * @param string $state
	 */
	public function addEventState($event, $state)
	{
		$this->storage[$event] = $state;
	}


	/**
	 * @param string $event
	 * @return string
	 */
	public function getEventState($event)
	{
		if (isset($this->storage[$event])) {
			return $this->storage[$event];
		}
		return FALSE;
	}

}
