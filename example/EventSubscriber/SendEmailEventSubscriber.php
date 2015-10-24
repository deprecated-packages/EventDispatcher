<?php

namespace MyApp\EventSubscriber;

use MyApp\Event\AppEvents;
use MyApp\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class SendEmailAboutUserLoginEventSubscriber implements EventSubscriberInterface
{

	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents()
	{
		return [AppEvents::ON_LOGIN => 'sendEmail'];
	}


	public function sendEmail(UserLoginEvent $userLoginEvent)
	{
		$userName = $userLoginEvent->getName();
		// send a notification email that `$userName` just logged in
		// ...
	}

}
