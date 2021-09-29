<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Exception;

use Colvin\CommonDomain\Domain\Exception\AggregateException;
use Colvin\CommonDomain\Domain\Exception\DomainException;
use Colvin\CommonDomain\Domain\Exception\ExistsException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExistsExceptionTest extends TestCase
{
    private MockObject $existsException;

    protected function setUp(): void
    {
        $this->existsException = $this->getMockForAbstractClass(ExistsException::class);
    }

    public function testThatExistsExceptionIsInstanceOfAggregateException(): void
    {
        static::assertInstanceOf(AggregateException::class, $this->existsException);
    }

    public function testThatExistsExceptionIsAnInstanceOfThrowable(): void
    {
        static::assertInstanceOf(\Throwable::class, $this->existsException);
    }
}