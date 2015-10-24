<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\Contract\DI;


interface NetteEventItemInterface
{

	/**
	 * @return string
	 */
	function getClass();


	/**
	 * @return string
	 */
	function getEventClass();


	/**
	 * @return string
	 */
	function getEventName();


	/**
	 * @return string
	 */
	function getProperty();

}
