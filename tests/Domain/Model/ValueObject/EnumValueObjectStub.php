<?php
declare(strict_types=1);

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use Colvin\CommonDomain\Domain\Model\ValueObject\EnumValueObject;

class EnumValueObjectStub extends EnumValueObject
{
    public const TEST_VALUE_A = 'a';
    public const TEST_VALUE_B = 'b';
}