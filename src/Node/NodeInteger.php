<?php

declare(strict_types=1);

namespace src\Node;

class NodeInteger extends NodeAbstract
{
    public function __construct(
        private readonly int $value,
    ) {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
