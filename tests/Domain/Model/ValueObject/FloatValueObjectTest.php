<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use Colvin\CommonDomain\Domain\Model\ValueObject\FloatValueObject;
use PHPUnit\Framework\TestCase;

class FloatValueObjectTest extends TestCase
{
    public function testFloatValueObjectValueAndSerialization(): void
    {
        $floatValueObject = FloatValueObjectStub::from(\M_SQRT2);

        self::assertEquals(\M_SQRT2, $floatValueObject->value());
        self::assertEquals(\M_SQRT2, $floatValueObject->jsonSerialize());
    }

    public function testFloatValueObjectEquals(): void
    {
        $floatValueObject = FloatValueObjectStub::from(3.14);
        $otherFloatValueObject = FloatValueObjectStub::from(3.14);
        $nonEqualFloatValueObject = FloatValueObjectStub::from(3.15);

        self::assertTrue($floatValueObject->equalTo($otherFloatValueObject));
        self::assertFalse($floatValueObject->equalTo($nonEqualFloatValueObject));
    }
}
