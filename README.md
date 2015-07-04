# Symnedi/EventDispatcher

[![Build Status](https://img.shields.io/travis/Symnedi/EventDispatcher.svg?style=flat-square)](https://travis-ci.org/Symnedi/EventDispatcher)
[![Quality Score](https://img.shields.io/scrutinizer/g/Symnedi/EventDispatcher.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symnedi/EventDispatcher)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Symnedi/EventDispatcher.svg?style=flat-square)](https://scrutinizer-ci.com/g/Symnedi/EventDispatcher)
[![Downloads this Month](https://img.shields.io/packagist/dm/symnedi/event-dispatcher.svg?style=flat-square)](https://packagist.org/packages/symnedi/event-dispatcher)
[![Latest stable](https://img.shields.io/packagist/v/symnedi/event-dispatcher.svg?style=flat-square)](https://packagist.org/packages/symnedi/event-dispatcher)


## Install

Via Composer:

```sh
$ composer require symnedi/event-dispatcher
```

Register the extension in `config.neon`:

```yaml
extensions:
	- Symnedi\EventDispatcher\DI\EventDispatcherExtension
```


## Usage

Great intro to EventDispatcher might give you [this presentation with real-life examples](http://www.slideshare.net/DigitalPoetsSociety/symfony2-components-the-event-dispatcher).

See [Symfony documentation](http://symfony.com/doc/current/components/event_dispatcher/introduction.html).


## Testing

```sh
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
