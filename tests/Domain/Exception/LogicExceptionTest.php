<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Exception;

use Colvin\CommonDomain\Domain\Exception\DomainException;
use Colvin\CommonDomain\Domain\Exception\LogicException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LogicExceptionTest extends TestCase
{
    private MockObject $logicException;

    protected function setUp(): void
    {
        $this->logicException = $this->getMockForAbstractClass(LogicException::class);
    }

    public function testThatClassHasADataMethodThatReturnsArray(): void
    {
        static::assertTrue(
            method_exists($this->logicException, 'data'),
            'Class does not have method data'
        );

        static::assertIsArray($this->logicException->data());
    }

    public function testThatLogicExceptionIsInstanceOfDomainException()
    {
        static::assertInstanceOf(DomainException::class, $this->logicException);
    }

    public function testThatLogicExceptionIsAnInstanceOfThrowable(): void
    {
        static::assertInstanceOf(\Throwable::class, $this->logicException);
    }

    public function testThatClassHasAJsonSerializeMethodThatReturnsExpectedArray(): void
    {
        static::assertTrue(
            method_exists($this->logicException, 'jsonSerialize'),
            'Class does not have method jsonSerialize'
        );

        $this->prepareDataArray();

        $serialized = $this->logicException->jsonSerialize();

        static::assertArrayHasKey('keyA', $serialized);
        static::assertArrayHasKey('keyB', $serialized);

        static::assertEquals('valueA', $serialized['keyA']);
        static::assertEquals('valueB', $serialized['keyB']);
    }

    private function prepareDataArray(): void
    {
        $this->logicException
            ->expects($this->once())
            ->method('data')
            ->will($this->returnValue([
                'keyA' => 'valueA',
                'keyB' => 'valueB'
            ]));
    }
}