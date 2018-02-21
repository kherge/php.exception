[![Build Status](https://travis-ci.org/kherge/php.exception.svg?branch=master)](https://travis-ci.org/kherge/php.exception)
[![Quality Gate](https://sonarcloud.io/api/project_badges/measure?project=php.exception&metric=alert_status)](https://sonarcloud.io/dashboard?id=php.exception)

Exception
=========

Simplifies the process of constructing new exceptions using formatted messages.

Usage
-----

```php
use KHerGe\Exception\AbstractException;

class MyException extends AbstractException
{
}

// Without any arguments.
$exception = new MyException();

// With only a message. ("Example message.")
$exception = new MyException('Example message.');

// With a message format and values to format. ("Example message.")
$exception = new MyException('Example %s.', 'message');

// With only a previous exception.
$exception = new MyException($previous);

// With a message and previous exception.
$exception = new MyException('Example message.', $previous);

// With a message format, values to format, and a previous exception.
$exception = new MyException('Example %s.', 'message', $previous);
```

Requirements
------------

- PHP 7.1 or greater

Installation
------------

Use Composer to install the package as a dependency.

    $ composer require kherge/exception

Testing
-------

Use PHPUnit 7.0 to run the test suite.

    $ phpunit

License
-------

This library is available under the Apache 2.0 and MIT licenses.