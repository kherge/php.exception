<?php

declare(strict_types=1);

namespace KHerGe\Exception;

use Exception;
use KHerGe\Exception\AbstractException;
use PHPUnit\Framework\TestCase;

/**
 * Verifies that the abstract exception functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class AbstractExceptionTest extends TestCase
{
    /**
     * Verify that an exception is constructed without any arguments.
     */
    public function testConstructWithoutArguments()
    {
        $exception = new class() extends AbstractException {};

        self::assertEquals('', $exception->getMessage(), 'A message must not be present.');
        self::assertEquals(0, $exception->getCode(), 'The code must always be zero.');
        self::assertNull($exception->getPrevious(), 'No previous exception must be present.');
    }

    /**
     * Verify that an exception is constructed using only a message.
     */
    public function testConstructWithMessage()
    {
        $message = 'Test message.';
        $exception = new class($message) extends AbstractException {};

        self::assertEquals($message, $exception->getMessage(), 'The message must be set properly.');
        self::assertEquals(0, $exception->getCode(), 'The code must always be zero.');
        self::assertNull($exception->getPrevious(), 'No previous exception must be present.');
    }

    /**
     * Verify that an exception is constructed using a message and values to format.
     */
    public function testConstructWithMessageAndValues()
    {
        $message = 'Test %s.';
        $values = ['message'];
        $exception = new class($message, ...$values) extends AbstractException {};

        $formatted = sprintf($message, ...$values);

        self::assertEquals($formatted, $exception->getMessage(), 'The message must formatted properly.');
        self::assertEquals(0, $exception->getCode(), 'The code must always be zero.');
        self::assertNull($exception->getPrevious(), 'No previous exception must be present.');
    }

    /**
     * Verify that an exception is constructed using only a previous exception.
     */
    public function testConstructWithPreviousException()
    {
        $previous = new Exception();
        $exception = new class($previous) extends AbstractException {};

        self::assertEquals('', $exception->getMessage(), 'A message must not be present.');
        self::assertEquals(0, $exception->getCode(), 'The code must always be zero.');
        self::assertSame($previous, $exception->getPrevious(), 'The previous exception must be set properly.');
    }

    /**
     * Verify that an exception is constructed using a message and previous exception.
     */
    public function testConstructWithMessageAndPreviousException()
    {
        $message = 'Test message.';
        $previous = new Exception();
        $exception = new class($message, $previous) extends AbstractException {};

        self::assertEquals($message, $exception->getMessage(), 'The message must be set properly.');
        self::assertEquals(0, $exception->getCode(), 'The code must always be zero.');
        self::assertSame($previous, $exception->getPrevious(), 'The previous exception must be set properly.');
    }

    /**
     * Verify that an exception is constructed using a message, values, and previous exception.
     */
    public function testConstructWithMessageValuesAndPreviousException()
    {
        $message = 'Test %s.';
        $previous = new Exception();
        $values = ['message', $previous];
        $exception = new class($message, ...$values) extends AbstractException {};

        $formatted = sprintf($message, ...$values);

        self::assertEquals($formatted, $exception->getMessage(), 'The message must formatted properly.');
        self::assertEquals(0, $exception->getCode(), 'The code must always be zero.');
        self::assertSame($previous, $exception->getPrevious(), 'The previous exception must be set properly.');
    }
}