<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\DI;

use Symnedi\EventDispatcher\Contract\DI\NetteEventItemInterface;


final class NetteEventItem implements NetteEventItemInterface
{

	/**
	 * @var string
	 */
	private $class;

	/**
	 * @var string
	 */
	private $property;

	/**
	 * @var string
	 */
	private $eventClass;

	/**
	 * @var string
	 */
	private $eventName;


	/**
	 * @param string $class
	 * @param string $property
	 * @param string $eventClass
	 * @param string $eventName
	 */
	public function __construct($class, $property, $eventClass, $eventName)
	{
		$this->class = $class;
		$this->property = $property;
		$this->eventClass = $eventClass;
		$this->eventName = $eventName;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getClass()
	{
		return $this->class;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getEventClass()
	{
		return $this->eventClass;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getEventName()
	{
		return $this->eventName;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getProperty()
	{
		return $this->property;
	}

}
