<?php

namespace Colvin\CommonDomain\Tests\Domain\Model\ValueObject;

use Colvin\CommonDomain\Domain\Model\ValueObject\CollectionValueObject;

class CollectionValueObjectStub extends CollectionValueObject
{
    public static function from(array $array): CollectionValueObjectStub
    {
        return new static($array);
    }

    protected function type(): string
    {
        return 'string';
    }
}