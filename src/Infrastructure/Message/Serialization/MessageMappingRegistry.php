<?php

declare(strict_types=1);

namespace Colvin\CommonDomain\Infrastructure\Message\Serialization;

final class MessageMappingRegistry
{
    public function __construct(private array $registry)
    {
    }

    public function __invoke(string $messageName): ?string
    {
        return $this->registry[$messageName] ?? null;
    }
}
