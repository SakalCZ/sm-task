<?php

declare(strict_types=1);

namespace src;

use DateTime;

class MemoryChecker
{
    public function print(): void
    {
        Helpers::dump('[MEM-INFO]: time is ' . (new DateTime())->format('Y-m-d H:i:s'));
        Helpers::dump('[MEM-INFO]: mem peak: ' . $this->getActualMemoryPeak() . 'MB');
        Helpers::dump('[MEM-INFO]: mem actual usage: ' . $this->getActualMemoryActual() . 'MB');
    }

    private function getActualMemoryPeak(): float
    {
        return round(memory_get_peak_usage(true) / 1024 / 1024, 2);
    }

    private function getActualMemoryActual(): float
    {
        return round(memory_get_usage(true) / 1024 / 1024, 2);
    }
}
