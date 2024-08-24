<?php

declare(strict_types=1);

namespace src\Node;

abstract class NodeAbstract implements NodeInterface
{
    protected bool $isHead = false;
    protected int $pointer;
    protected ?int $nextPointer = null;
    protected ?int $previousPointer = null;

    public function isHead(): bool
    {
        return $this->isHead;
    }

    public function setIsHead(bool $isHead): void
    {
        $this->isHead = $isHead;
    }

    public function getPointer(): int
    {
        return $this->pointer;
    }

    public function setPointer(int $pointer): void
    {
        $this->pointer = $pointer;
    }

    public function getNextPointer(): ?int
    {
        return $this->nextPointer;
    }

    public function setNextPointer(?int $nextPointer): void
    {
        $this->nextPointer = $nextPointer;
    }

    public function getPreviousPointer(): ?int
    {
        return $this->previousPointer;
    }

    public function setPreviousPointer(?int $previousPointer): void
    {
        $this->previousPointer = $previousPointer;
    }
}
