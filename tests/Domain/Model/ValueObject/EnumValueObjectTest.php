<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use PHPUnit\Framework\TestCase;

class EnumValueObjectTest extends TestCase
{
    public function testCreationAndValue(): void
    {
        $valueObject = EnumValueObjectStub::from(EnumValueObjectStub::TEST_VALUE_A);
        static::assertEquals(EnumValueObjectStub::TEST_VALUE_A, $valueObject->value());
    }

    public function testThatAllowedValuesContainsExpectedValues(): void
    {
        static::assertContains(EnumValueObjectStub::TEST_VALUE_A, EnumValueObjectStub::allowedValues());
        static::assertContains(EnumValueObjectStub::TEST_VALUE_B, EnumValueObjectStub::allowedValues());
        static::assertCount(2, EnumValueObjectStub::allowedValues());
        static::assertNotContains('illegal value', EnumValueObjectStub::allowedValues());
    }

    public function testThatIllegalValueThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        EnumValueObjectStub::from('illegal value');
    }
}