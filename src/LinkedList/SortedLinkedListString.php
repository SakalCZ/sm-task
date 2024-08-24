<?php

declare(strict_types=1);

namespace src\LinkedList;

use src\Node\NodeString;

class SortedLinkedListString extends LinkedListAbstract
{
    public function addValue(int|string $value): void
    {
        if (!is_string($value)) {
            throw new \ValueError("Value must be a string");
        }

        // create & set basics about the node
        $node = new NodeString($value);
        // @todo
    }
}
