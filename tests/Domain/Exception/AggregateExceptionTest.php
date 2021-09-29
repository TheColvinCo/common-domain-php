<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Exception;

use Colvin\CommonDomain\Domain\Exception\AggregateException;
use Colvin\CommonDomain\Domain\Exception\DomainException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AggregateExceptionTest extends TestCase
{
    private MockObject $aggregateException;

    protected function setUp(): void
    {
        $this->aggregateException = $this->getMockForAbstractClass(AggregateException::class);
    }

    public function testThatClassHasAIdMethodThatReturnsString(): void
    {
        static::assertTrue(
            \method_exists($this->aggregateException, 'id'),
            'Class does not have method id'
        );

        static::assertIsString($this->aggregateException->id());
    }

    public function testThatClassHasAAggregateTypeMethodThatReturnsString(): void
    {
        static::assertTrue(
            method_exists($this->aggregateException, 'aggregateType'),
            'Class does not have method aggregateType'
        );

        static::assertIsString($this->aggregateException->aggregateType());
    }

    public function testThatClassHasAJsonSerializeMethodThatReturnsExpectedArray(): void
    {
        static::assertTrue(
            method_exists($this->aggregateException, 'jsonSerialize'),
            'Class does not have method jsonSerialize'
        );

        $this->prepareAggregateTypeMethod();
        $this->prepareIdMethod();

        $serialized = $this->aggregateException->jsonSerialize();

        static::assertArrayHasKey('id', $serialized);
        static::assertArrayHasKey('aggregateType', $serialized);

        static::assertEquals('aggregateTypeExample', $serialized['aggregateType']);
        static::assertEquals('exampleId', $serialized['id']);
    }

    public function testThatAggregateExceptionIsAnInstanceOfDomainException(): void
    {
        static::assertInstanceOf(DomainException::class, $this->aggregateException);
    }

    public function testThatAggregateExceptionIsAnInstanceOfThrowable(): void
    {
        static::assertInstanceOf(\Throwable::class, $this->aggregateException);
    }


    private function prepareAggregateTypeMethod(): void
    {
        $this->aggregateException
            ->expects($this->once())
            ->method('aggregateType')
            ->will($this->returnValue('aggregateTypeExample'));
    }

    private function prepareIdMethod(): void
    {
        $this->aggregateException
            ->expects($this->once())
            ->method('id')
            ->will($this->returnValue('exampleId'));
    }
}