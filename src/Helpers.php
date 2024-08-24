<?php

declare(strict_types=1);

namespace src;

class Helpers
{
    public static function dump(mixed $value): void
    {
        echo PHP_EOL;
        var_export($value);
        echo PHP_EOL;
    }
}
