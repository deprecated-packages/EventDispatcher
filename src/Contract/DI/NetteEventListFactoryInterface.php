<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\Contract\DI;


interface NetteEventListFactoryInterface
{

	/**
	 * @return NetteEventItemInterface[]
	 */
	function create();

}
