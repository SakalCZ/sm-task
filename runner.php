<?php

declare(strict_types=1);

use src\Helpers;
use src\LinkedList\SortedLinkedListInteger;
use src\MemoryChecker;

include __DIR__ . '/src/Helpers.php';
include __DIR__ . '/src/MemoryChecker.php';
include __DIR__ . '/src/Node/NodeInterface.php';
include __DIR__ . '/src/Node/NodeAbstract.php';
include __DIR__ . '/src/Node/NodeInteger.php';
include __DIR__ . '/src/Node/NodeString.php';
include __DIR__ . '/src/LinkedList/LinkedListInterface.php';
include __DIR__ . '/src/LinkedList/LinkedListAbstract.php';
include __DIR__ . '/src/LinkedList/SortedLinkedListInteger.php';
include __DIR__ . '/src/LinkedList/SortedLinkedListString.php';

$memoryChecker = new MemoryChecker();

/*
 * switch here the case to process
 * possible values are `1` or `2`
 */
$runCase = 1;

/*
 * case 1 - some simple usage
 */
if ($runCase === 1) {
    $listCaseOne = new SortedLinkedListInteger();
    //$listCaseOne->debug = true;
    $memoryChecker->print();
    // ad some values
    Helpers::dump('-- Case 1 start --');
    $listCaseOne->addValue(10);
    $listCaseOne->addValue(11);
    $listCaseOne->addValue(12);
    $listCaseOne->addValue(13);
    $listCaseOne->addValue(20);
    $listCaseOne->addValue(19);
    $listCaseOne->addValue(18);
    $listCaseOne->addValue(17);
    $listCaseOne->addValue(17);
    $listCaseOne->addValue(17);
    $listCaseOne->addValue(18);
    $listCaseOne->addValue(1);
    $listCaseOne->addValue(1);
    $listCaseOne->addValue(1);
    $listCaseOne->addValue(1);
    $listCaseOne->addValue(100);
    $listCaseOne->addValue(1000000);
    $listCaseOne->addValue(500);
    $listCaseOne->addValue(20);
    $memoryChecker->print();
    Helpers::dump('-- Case 1 end --');

    // debug inner structure/helpers
    $listCaseOne->printClassHelpers();
    Helpers::dump('Nodes dump: ' . var_export($listCaseOne->getNodes(), true));

    // print the result
    Helpers::dump('==== sorted values ====');
    foreach ($listCaseOne->getSortedValues() as $value) {
        echo $value . ', ';
    }
}


/*
 * case 2 - do some performance test of the sorting
 */
if ($runCase === 2) {
    // Each number from specified intervals will be added to the list.
    $matrix = [
        // 5_000 values
        // max 5k times sorting operations for the value (each value is the greatest value that must be added to the end)
        [10_000,15_000],
        // 2_999 values
        // max 3k times sorting operations for the value  (it will stop by 10_000 value as the N value will move to required pointer)
        [1,3_000],
        // 1_000 values
        // max 1k+3k=4x times sorting operations for the value  (it will stop by 10_000 value as the N value will move to required pointer)
        [3_000,4_000],
        // 7_500 values
        // the slowest interval
        [12_500,20_000],
    ];
    // 16_499 values in total

    $memoryChecker->print();
    echo PHP_EOL . '==================';

    $listCaseTwo = new SortedLinkedListInteger();
    //$listCaseTwo->debug = true;
    foreach ($matrix as $interval) {
        Helpers::dump('! adding values interval ' . $interval[0] . ' - ' . $interval[1]);
        for ($i=$interval[0]; $i < $interval[1];$i++) {
            //echo '.';
            $listCaseTwo->addValue($i);
        }
        $memoryChecker->print();
    }
    Helpers::dump('==================');
    $memoryChecker->print();

    // debug inner structure/helpers
    $listCaseTwo->printClassHelpers();

    // print the result
//    Helpers::dump('==== sorted values ====');
//    foreach ($listCaseTwo->getSortedValues() as $value) {
//        echo $value . ', ';
//    }
}
