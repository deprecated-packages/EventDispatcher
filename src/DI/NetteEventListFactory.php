<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Nette\Application\Application;
use Symnedi\EventDispatcher\Event\ApplicationEvent;
use Symnedi\EventDispatcher\Event\ApplicationRequestEvent;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;


class NetteEventListFactory
{

	/**
	 * @return NetteEventItem[]
	 */
	public function create()
	{
		$list = [];
		$list[] = new NetteEventItem(
			Application::class, 'onStartup', ApplicationEvent::class, ApplicationEvents::ON_STARTUP
		);
		$list[] = new NetteEventItem(
			Application::class, 'onRequest', ApplicationRequestEvent::class, ApplicationEvents::ON_APPLICATION_REQUEST
		);
		return $list;
	}

}
