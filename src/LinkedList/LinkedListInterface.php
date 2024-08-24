<?php

declare(strict_types=1);

namespace src\LinkedList;

use Generator;

interface LinkedListInterface
{
    public function getNodes(): array;
    public function getSortedValues(): Generator;
    public function addValue(int|string $value): void;
}
