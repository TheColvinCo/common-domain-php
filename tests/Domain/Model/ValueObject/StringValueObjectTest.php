<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use PHPUnit\Framework\TestCase;

class StringValueObjectTest extends TestCase
{
    public function testConstructionAndValue(): void
    {
        $valueObject = StringValueObjectStub::from('testValue');
        static::assertEquals('testValue', $valueObject->value());
    }

    public function testEqualsToMethodIsTrue(): void
    {
        $valueObject = StringValueObjectStub::from('testValue');
        static::assertTrue($valueObject->equalTo(StringValueObjectStub::from('testValue')));
    }

    public function testEqualsToMethodIsFalse(): void
    {
        $valueObject = StringValueObjectStub::from('testValue');
        static::assertFalse($valueObject->equalTo(StringValueObjectStub::from('testValueB')));
    }

    public function testToStringMagicMethod(): void
    {
        $valueObject = StringValueObjectStub::from('testValue');
        static::assertEquals('testValue', $valueObject->__toString());
    }

    public function testJsonSerialize(): void
    {
        $valueObject = StringValueObjectStub::from('testValue');
        static::assertEquals('testValue', $valueObject->jsonSerialize());
    }
}