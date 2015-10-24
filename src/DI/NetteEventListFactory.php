<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Nette\Application\Application;
use Nette\Application\UI\Presenter;
use Symnedi\EventDispatcher\Contract\DI\NetteEventListFactoryInterface;
use Symnedi\EventDispatcher\Event\ApplicationEvent;
use Symnedi\EventDispatcher\Event\ApplicationExceptionEvent;
use Symnedi\EventDispatcher\Event\ApplicationPresenterEvent;
use Symnedi\EventDispatcher\Event\ApplicationRequestEvent;
use Symnedi\EventDispatcher\Event\ApplicationResponseEvent;
use Symnedi\EventDispatcher\Event\PresenterResponseEvent;
use Symnedi\EventDispatcher\NetteApplicationEvents;
use Symnedi\EventDispatcher\NettePresenterEvents;


final class NetteEventListFactory implements NetteEventListFactoryInterface
{

	/**
	 * {@inheritdoc}
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
	private function addApplicationEventItems(array $list)
	{
		$list[] = new NetteEventItem(
			Application::class, 'onRequest', ApplicationRequestEvent::class, NetteApplicationEvents::ON_REQUEST
		);
		$list[] = new NetteEventItem(
			Application::class, 'onStartup', ApplicationEvent::class, NetteApplicationEvents::ON_STARTUP
		);
		$list[] = new NetteEventItem(
			Application::class, 'onPresenter', ApplicationPresenterEvent::class, NetteApplicationEvents::ON_PRESENTER
		);
		$list[] = new NetteEventItem(
			Application::class, 'onResponse', ApplicationResponseEvent::class, NetteApplicationEvents::ON_RESPONSE
		);
		$list[] = new NetteEventItem(
			Application::class, 'onError', ApplicationExceptionEvent::class, NetteApplicationEvents::ON_ERROR
		);
		$list[] = new NetteEventItem(
			Application::class, 'onShutdown', ApplicationExceptionEvent::class, NetteApplicationEvents::ON_SHUTDOWN
		);
		return $list;
	}


	/**
	 * @param NetteEventItem[] $list
	 * @return NetteEventItem[]
	 */
	private function addPresenterEventItems(array $list)
	{
		$list[] = new NetteEventItem(
			Presenter::class, 'onShutdown', PresenterResponseEvent::class, NettePresenterEvents::ON_SHUTDOWN
		);
		return $list;
	}

}
