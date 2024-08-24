<?php

declare(strict_types=1);

namespace src\Node;

class NodeString extends NodeAbstract
{
    public function __construct(
        private readonly string $value,
    ) {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
