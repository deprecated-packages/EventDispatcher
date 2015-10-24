<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\Event;

use Nette\Application\Application;


final class ApplicationEvent extends AbstractEvent
{

	/**
	 * @var Application
	 */
	private $application;


	public function __construct(Application $application)
	{
		$this->application = $application;
	}


	/**
	 * @return Application
	 */
	public function getApplication()
	{
		return $this->application;
	}

}
