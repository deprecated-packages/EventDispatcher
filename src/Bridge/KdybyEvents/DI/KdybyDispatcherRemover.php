<?php

/**
 * This file is part of Symnedi.
 * Copyright (c) 2014 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symnedi\EventDispatcher\Bridge\KdybyEvents\DI;

use Closure;
use Nette\DI\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


final class KdybyDispatcherRemover
{

	public function removeFromContainer(ContainerBuilder $containerBuilder)
	{
		foreach ($containerBuilder->findByType(EventDispatcherInterface::class) as $name => $eventDispatcherDefinition) {
			if ($eventDispatcherDefinition->getFactory()->getEntity() === 'Kdyby\Events\SymfonyDispatcher') {
				// @bug workaround of https://github.com/nette/di/pull/71
				// also remove from definition class reference
//				$classRemover = function (ContainerBuilder $containerBuilder, $name, $class) {
//					if (isset($containerBuilder->classes[$class][TRUE])) {
//						foreach ($containerBuilder->classes[$class][TRUE] as $key => $definitionName) {
//							if ($name === $definitionName) {
//								unset($containerBuilder->classes[$class][TRUE][$key]);
//							}
//						}
//					}
//				};
				$class = $containerBuilder->getDefinition($name)->getClass();
				$classRemover = Closure::bind(call_user_func([$this, 'classRemoverCallback']), NULL, $containerBuilder);
				$classRemover($containerBuilder, $name, $class);

				$containerBuilder->removeDefinition($name);
			}
		}
	}


	private function classRemoverCallback(ContainerBuilder $containerBuilder, $name, $class)
	{
		function (ContainerBuilder $containerBuilder, $name, $class) {
			if (isset($containerBuilder->classes[$class][TRUE])) {
				foreach ($containerBuilder->classes[$class][TRUE] as $key => $definitionName) {
					if ($name === $definitionName) {
						unset($containerBuilder->classes[$class][TRUE][$key]);
					}
				}
			}
		};
	}

}
