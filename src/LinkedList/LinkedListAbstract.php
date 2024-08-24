<?php

declare(strict_types=1);

namespace src\LinkedList;

use Generator;
use src\Helpers;
use src\Node\NodeInteger;

abstract class LinkedListAbstract implements LinkedListInterface
{
    public bool $debug = false;

    /** @var NodeInteger[] */
    protected array $nodes = [];

    protected int $listSize = 0;
    protected int $firstNodeIndex;
    protected int $lastNodeIndex;
    protected int $indexBuffer;

    protected function debug(mixed $value): void
    {
        if ($this->debug === false) {
            return;
        }

        Helpers::dump($value);
    }

    public function printClassHelpers(): void
    {
        Helpers::dump('List size: ' . $this->listSize);
        Helpers::dump('First node index: ' . $this->firstNodeIndex);
        Helpers::dump('Last node index: ' . $this->lastNodeIndex);
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function getSortedValues(): Generator
    {
        $actualNode = $this->nodes[$this->firstNodeIndex];
        while ($actualNode !== null) {
            yield $actualNode->getValue();
            // finally move to next node
            $actualNode = $this->nodes[$actualNode->getNextPointer()] ?? null;
        }
    }

    public function addValue(int|string $value): void
    {
        // Implement addValue() in the class extending this abstraction.
    }
}
