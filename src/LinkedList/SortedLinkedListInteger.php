<?php

declare(strict_types=1);

namespace src\LinkedList;

use src\Node\NodeInteger;
use ValueError;

class SortedLinkedListInteger extends LinkedListAbstract
{
    public function addValue(int|string $value): void
    {
        if (!is_integer($value)) {
            throw new ValueError("Value must be an integer");
        }

        // create & set basics about the node
        $node = new NodeInteger($value);

        /*
         * first node
         */
        if ($this->nodes === []) {
            $node->setIsHead(true);
            $node->setPointer(0);

            $this->firstNodeIndex = 0;
            $this->lastNodeIndex = 0;
            $this->nodes[0] = $node;

            // keep track of the list size
            $this->listSize++;
            $this->indexBuffer = 0;

            return;
        }

        /*
         * N-th node
         * the basic logic is to make the node first in the list and then sort the list
         */
        // before adding N-th node, fetch the actually first node
        $firstNode = $this->nodes[$this->firstNodeIndex];

        // add new N-th node
        $this->indexBuffer++;
        $node->setPointer($this->indexBuffer);

        // first node (and newly the second value) pointer update
        $firstNode->setPreviousPointer($this->indexBuffer);
        $firstNode->setIsHead(false);

        // new node pointer update
        $node->setNextPointer($firstNode->getPointer());
        // new node is newly the head of the list
        $node->setIsHead(true);
        // finally add the new node to the list
        $this->nodes[$this->indexBuffer] = $node;

        // keep track of the list size
        // do it here because code below expects increased size
        $this->listSize++;

        // update first node index/pointer
        $this->firstNodeIndex = $node->getPointer();

        // after each add sort the list
        $this->sortList();
    }

    private function sortList(): void
    {
        $actualNode = $this->nodes[$this->firstNodeIndex];
        $this->debug('SORTING');
        $this->debug($actualNode);

        while ($actualNode !== null) {
            $this->debug('--- iteration step ---');
            $this->debug('Actual node value: ' . $actualNode->getValue());

            // we have iterated to the last node - break it
            if (!isset($this->nodes[$actualNode->getNextPointer()])) {
                // potential new last node - mark last node index
                $this->lastNodeIndex = $actualNode->getPointer();
                break;
            }

            // we have next node to compare with actual node
            $nextNode = $this->nodes[$actualNode->getNextPointer()];
            $this->debug($nextNode);

            if ($this->isValueOfActualNodeGreaterThanNextNode($actualNode->getValue(), $nextNode->getValue())) {
                // How the switch is processed - example:
                // node-10 -> next node-11
                // node-11 -> next node-12 <--- actually processing node
                // node-12 -> next node-13 <--- next node
                // Switching nodes 11 and 12 means operations:
                //   - node-10 -> next node-12
                //   - node-12 -> next node-11
                //   - node-11 -> next node-13
                $this->debug("Actual node [value={$actualNode->getValue()}] is greater than next node`s [value={$nextNode->getValue()}] -> switch them...");

                // previous node might not exist for the first node
                $previousNode = $this->nodes[$actualNode->getPreviousPointer()] ?? null;

                /*
                 * store the values so we avoid overriding while processing
                 */
                // for previous pointer is changed only next pointer
                $previousNodeNewNextPointer = $nextNode->getPointer();
                // for actual pointer is changed previous and next pointer
                $actualNodeNewPreviousPointer = $nextNode->getPointer();
                $actualNodeNewNextPointer = $nextNode->getNextPointer();
                // for next pointer is changed previous and next pointer
                $nextNodeNewPreviousPointer = $previousNode?->getPointer();
                $nextNodeNewNextPointer = $actualNode->getPointer();

                // finally override pointers
                if ($previousNode) {
                    $previousNode->setNextPointer($previousNodeNewNextPointer);
                }
                $actualNode->setPreviousPointer($actualNodeNewPreviousPointer);
                $actualNode->setNextPointer($actualNodeNewNextPointer);
                $nextNode->setPreviousPointer($nextNodeNewPreviousPointer);
                $nextNode->setNextPointer($nextNodeNewNextPointer);

                // special case - switched element is HEAD
                if ($actualNode->isHead()) {
                    $actualNode->setIsHead(false);
                    $nextNode->setIsHead(true);
                    $this->firstNodeIndex = $nextNode->getPointer();
                    $this->lastNodeIndex = $nextNode->getPointer();
                }

            } else {
                $this->debug('No switching action needed.');

                $nextNextNode = $this->nodes[$nextNode->getNextPointer()] ?? null;

                if ($nextNextNode && !$this->isValueOfActualNodeGreaterThanNextNode($nextNode->getValue(), $nextNextNode->getValue())) {
                    $this->debug('Sorting was applied in the past - that means we reached point from which the data are sorted. Exiting the iteration.');
                }
            }

            // finally move to next node
            $actualNode = $nextNode;
        }
    }

    protected function isValueOfActualNodeGreaterThanNextNode(int $actualNode, int $nextNode): bool
    {
        return $actualNode > $nextNode;
    }
}
