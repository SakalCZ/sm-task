<?php

declare(strict_types=1);

namespace src\Node;

interface NodeInterface
{
    public function getValue(): int|string;
}
