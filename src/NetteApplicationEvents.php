<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher;


/**
 * Events in Nette Application life cycle.
 */
class NetteApplicationEvents
{

	/**
	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\ApplicationEvent instance.
	 *
	 * @var string
	 */
	const ON_STARTUP = 'Nette\Application\Application::onStartup';

	/**
	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\ApplicationExceptionEvent instance.
	 *
	 * @var string
	 */
	const ON_SHUTDOWN = 'Nette\Application\Application::onShutdown';

	/**
	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\ApplicationRequestEvent instance.
	 *
	 * @var string
	 */
	const ON_REQUEST = 'Nette\Application\Application::onRequest';

	/**
	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\ApplicationPresenterEvent instance.
	 *
	 * @var string
	 */
	const ON_PRESENTER = 'Nette\Application\Application::onPresenter';

	/**
	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\ApplicationExceptionEvent instance.
	 *
	 * @var string
	 */
	const ON_RESPONSE = 'Nette\Application\Application::onResponse';

	/**
 	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\ApplicationExceptionEvent instance.
	 *
	 * @var string
	 */
	const ON_ERROR = 'Nette\Application\Application::onError';

}
