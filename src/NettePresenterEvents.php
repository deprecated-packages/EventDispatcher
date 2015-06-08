<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher;

use Nette\Application\UI\Presenter;


/**
 * Events in Nette Presenter life cycle.
 */
final class NettePresenterEvents
{

	/**
	 * The ON_SHUTDOWN event occurs when the presenter is shutting down,
	 * @see Nette\Application\UI\Presenter::$onShutdown.
	 *
	 * The event listener method receives a @see Symnedi\EventDispatcher\Event\PresenterResponseEvent instance.
	 *
	 * @var string
	 */
	const ON_SHUTDOWN = Presenter::class . '::onShutdown';

}
