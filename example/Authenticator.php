<?php


namespace MyApp;


use MyApp\Event\AppEvents;
use MyApp\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class Authenticator
{

	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcherInterface;


	public function __construct(EventDispatcherInterface $eventDispatcherInterface)
	{
		$this->eventDispatcherInterface = $eventDispatcherInterface;
	}


	/**
	 * @param string $email
	 * @param string $password
	 */
	public function login($email, $password)
	{
		// some verification code here
		$success = '...';

		if ($success) {
			$userLoginEvent = new UserLoginEvent($email);
			$this->eventDispatcherInterface->dispatch(AppEvents::ON_LOGIN, $userLoginEvent);
			// That's it! You've just successfully used an event.
		}
	}

}
