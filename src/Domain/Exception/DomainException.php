<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Domain\Exception;

abstract class DomainException extends \DomainException implements \JsonSerializable
{
}
