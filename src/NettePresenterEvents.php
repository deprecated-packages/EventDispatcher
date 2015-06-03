<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher;


/**
 * Events in Nette Presenter life cycle.
 */
class NettePresenterEvents
{

	/**
	 * @var string
	 */
	const ON_SHUTDOWN = 'Nette\Application\UI\Presenter::onShutdown';

}
