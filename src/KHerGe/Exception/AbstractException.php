<?php

declare(strict_types=1);

namespace KHerGe\Exception;

use Exception;
use Throwable;

/**
 * An abstract exception that supports formatted messages.
 *
 * To use this exception, a class must be created that extends it.
 *
 * ```
 * class MyException extends AbstractException
 * {
 * }
 * ```
 *
 * Exceptions that are based on this class can then be constructed in one of many ways.
 *
 * ```
 * // Without any arguments.
 * $exception = new MyException();
 *
 * // With only a message. ("Example message.")
 * $exception = new MyException('Example message.');
 *
 * // With a message format and values to format. ("Example message.")
 * $exception = new MyException('Example %s.', 'message');
 *
 * // With only a previous exception.
 * $exception = new MyException($previous);
 *
 * // With a message and previous exception.
 * $exception = new MyException('Example message.', $previous);
 *
 * // With a message format, values to format, and a previous exception.
 * $exception = new MyException('Example %s.', 'message', $previous);
 * ```
 *
 * It is important to note a few things when constructing instances based on this class:
 *
 * - the code will always be `0` (zero)
 * - messages are formatted using [`sprintf()`][]
 * - if the last argument is an instance of a `Throwable` class, it will always be treated as a previous exception
 *
 * [`sprintf()`]: https://secure.php.net/sprintf
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
abstract class AbstractException extends Exception
{
    /**
     * Initializes the new exception with the given message.
     *
     * @param string    $format    The message format.
     * @param mixed     $value,... A value to format.
     * @param Throwable $cause     The cause of the exception.
     */
    public function __construct(...$value)
    {
        $cause = null;
        $format = '';

        if (end($value) instanceof Throwable) {
            $cause = array_pop($value);
        }

        if (!empty($value)) {
            $format = array_shift($value);

            if (!empty($value)) {
                $format = sprintf($format, ...$value);
            }
        }

        parent::__construct($format, 0, $cause);
    }
}