<?php

namespace MyApp\Event;


/**
 * Events in my Application.
 *
 * Note: Here you can list all the events, and use constants as references in your code.
 * This will make it easier to understand them and use them by some other programmer.
 */
final class AppEvents
{

	/**
	 * The ON_LOGIN occurs when user is logged in,
	 * @see MyApp\Authenticator::login()
	 *
	 * The event listener method receives a @see MyApp\Event\UserLoginEvent instance.
	 *
	 * @var string
	 */
	const ON_LOGIN = 'app.onLogin';

}
