<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Exception;

use Colvin\CommonDomain\Domain\Exception\DomainException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DomainExceptionTest extends TestCase
{
    private MockObject $domainException;

    protected function setUp(): void
    {
        $this->domainException = $this->getMockForAbstractClass(DomainException::class);
    }

    public function testThatDomainExceptionIsInstanceOfSPLDomainException(): void
    {
        static::assertInstanceOf(\DomainException::class, $this->domainException);
    }

    public function testThatDomainExceptionIsInstanceOfJsonSerializable(): void
    {
        static::assertInstanceOf(\JsonSerializable::class, $this->domainException);
    }

    public function testThatDomainExceptionIsAnInstanceOfThrowable(): void
    {
        static::assertInstanceOf(\Throwable::class, $this->domainException);
    }
}