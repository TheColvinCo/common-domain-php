<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Model\ValueObject;

class NotEmptyStringValueObject extends StringValueObject
{
    protected function __construct(string $value)
    {
        $this->guardNotEmptyString($value);
        parent::__construct($value);
    }

    private function guardNotEmptyString(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Value can not be empty');
        }
    }
}
