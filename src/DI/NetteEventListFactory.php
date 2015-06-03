<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Nette\Application\Application;
use Nette\Application\UI\Presenter;
use Symnedi\EventDispatcher\Event\ApplicationEvent;
use Symnedi\EventDispatcher\Event\ApplicationExceptionEvent;
use Symnedi\EventDispatcher\Event\ApplicationPresenterEvent;
use Symnedi\EventDispatcher\Event\ApplicationRequestEvent;
use Symnedi\EventDispatcher\Event\ApplicationResponseEvent;
use Symnedi\EventDispatcher\Event\PresenterResponseEvent;
use Symnedi\EventDispatcher\Nette\ApplicationEvents;
use Symnedi\EventDispatcher\Nette\PresenterEvents;


class NetteEventListFactory
{

	/**
	 * @return NetteEventItem[]
	 */
	public function create()
	{
		$list = [];
		$list = $this->addApplicationEventItems($list);
		$list = $this->addPresenterEventItems($list);
		return $list;
	}


	/**
	 * @param NetteEventItem[] $list
	 * @return NetteEventItem[]
	 */
	private function addApplicationEventItems($list)
	{
		$list[] = new NetteEventItem(
			Application::class, 'onRequest', ApplicationRequestEvent::class, ApplicationEvents::ON_REQUEST
		);
		$list[] = new NetteEventItem(
			Application::class, 'onStartup', ApplicationEvent::class, ApplicationEvents::ON_STARTUP
		);
		$list[] = new NetteEventItem(
			Application::class, 'onPresenter', ApplicationPresenterEvent::class, ApplicationEvents::ON_PRESENTER
		);
		$list[] = new NetteEventItem(
			Application::class, 'onResponse', ApplicationResponseEvent::class, ApplicationEvents::ON_RESPONSE
		);
		$list[] = new NetteEventItem(
			Application::class, 'onError', ApplicationExceptionEvent::class, ApplicationEvents::ON_ERROR
		);
		$list[] = new NetteEventItem(
			Application::class, 'onShutdown', ApplicationExceptionEvent::class, ApplicationEvents::ON_SHUTDOWN
		);
		return $list;
	}


	/**
	 * @param NetteEventItem[] $list
	 * @return NetteEventItem[]
	 */
	private function addPresenterEventItems($list)
	{
		$list[] = new NetteEventItem(
			Presenter::class, 'onShutdown', PresenterResponseEvent::class, PresenterEvents::ON_SHUTDOWN
		);
		return $list;
	}

}
