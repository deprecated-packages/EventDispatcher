<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\Event;

use Throwable;
use Nette\Application\Application;
use Symfony\Component\EventDispatcher\Event;


final class ApplicationExceptionEvent extends Event
{

	/**
	 * @var Application
	 */
	private $application;

	/**
	 * @var Throwable
	 */
	private $throwable;


	public function __construct(Application $application, Throwable $throwable = NULL)
	{
		$this->application = $application;
		$this->throwable   = $throwable;
	}


	/**
	 * @return Application
	 */
	public function getApplication()
	{
		return $this->application;
	}


	/**
	 * @return Exception
	 */
	public function getThrowable()
	{
		return $this->throwable;
	}

}
