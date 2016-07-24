<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\Event;

use Nette\Application\Application;
use Symfony\Component\EventDispatcher\Event;


final class ApplicationExceptionEvent extends Event
{

	/**
	 * @var Application
	 */
	private $application;

	/**
	 * @var \Throwable|\Exception|NULL
	 */
	private $exception;


	/**
	 * @param Application $application
	 * @param \Throwable|\Exception|NULL $exception
	 */
	public function __construct(Application $application, $exception = NULL)
	{
		$this->application = $application;
		$this->exception = $exception;
	}


	/**
	 * @return Application
	 */
	public function getApplication()
	{
		return $this->application;
	}


	/**
	 * @return \Throwable|\Exception|NULL
	 */
	public function getException()
	{
		return $this->exception;
	}

}
