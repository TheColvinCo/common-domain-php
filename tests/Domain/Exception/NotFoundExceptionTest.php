<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Exception;

use Colvin\CommonDomain\Domain\Exception\AggregateException;
use Colvin\CommonDomain\Domain\Exception\NotFoundException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class NotFoundExceptionTest extends TestCase
{
    private MockObject $notFoundException;

    public function setUp(): void
    {
        $this->notFoundException = $this->getMockForAbstractClass(NotFoundException::class);
    }

    public function testThatNotFoundExceptionIsInstanceOfAggregateException(): void
    {
        static::assertInstanceOf(AggregateException::class, $this->notFoundException);
    }

    public function testThatANotFoundExceptionIsAnInstanceOfThrowable(): void
    {
        static::assertInstanceOf(\Throwable::class, $this->notFoundException);
    }
}