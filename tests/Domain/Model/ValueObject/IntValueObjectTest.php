<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use PHPUnit\Framework\TestCase;

class IntValueObjectTest extends TestCase
{
    public function testCreationAndValue(): void
    {
        $valueObject = IntValueObjectStub::from(1);
        static::assertEquals(1, $valueObject->value());
    }

    public function testEquals(): void
    {
        $valueObject = IntValueObjectStub::from(3);
        static::assertTrue($valueObject->equalTo(IntValueObjectStub::from(3)));
        static::assertFalse($valueObject->equalTo(IntValueObjectStub::from(2)));
    }

    public function testThatJsonSerializeReturnsExpectedValue(): void
    {
        $valueObject = IntValueObjectStub::from(1);
        static::assertEquals(1, $valueObject->jsonSerialize());
    }

}