# Symnedi/EventDispatcher

[![Build Status](https://img.shields.io/travis/Symnedi/EventDispatcher.svg?style=flat-square)](https://travis-ci.org/Symnedi/EventDispatcher)
[![Quality Score](https://img.shields.io/scrutinizer/g/Symnedi/EventDispatcher.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symnedi/EventDispatcher)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Symnedi/EventDispatcher.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symnedi/EventDispatcher)
[![Downloads](https://img.shields.io/packagist/dt/symnedi/event-dispatcher.svg?style=flat-square)](https://packagist.org/packages/symnedi/event-dispatcher)
[![Latest stable](https://img.shields.io/packagist/v/symnedi/event-dispatcher.svg?style=flat-square)](https://packagist.org/packages/symnedi/event-dispatcher)

Integration of Symfony\EventDispatcher into Nette\DI.



## Install

```sh
$ composer require symnedi/event-dispatcher
```

Register the extension in `config.neon`:

```yaml
extensions:
	- Symnedi\EventDispatcher\DI\EventDispatcherExtension
```


## Usage

There are 3 important parts using EventDispatcher:

- Event
- EventSubscriber
- EventDispatcher

*Event* is value object, it simply stores data we use - e.g. user email and password.

*EventSubscriber* listens to certain event and invokes some action, when that happens - when user logs in. 

*EventDispatcher* invokes the event in the place where it happens - in the login form just after the login method.

To see the real code in practise, there is [example section](example) with both Event and EventSubscriber.
 
Also you can find [`AppEvents.php`](example/Event/AppEvents.php) that basically lists all used events. It's not necessary for the starters, just convenient in huge applications.


For more details, check [Symfony documentation](http://symfony.com/doc/current/components/event_dispatcher/introduction.html),
or [this very nice presentation](http://www.slideshare.net/DigitalPoetsSociety/symfony2-components-the-event-dispatcher) with real-life examples. 


## Testing

```sh
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
