<?php

declare(strict_types=1);

namespace parkrunReporter\Random;

/**
 * An implementation of a random source using the weaker PHP functions.
 * This uses simple PHP functions and should not be relied upon for encryption or similar.
 */
class WeakRandom implements RandomSourceInterface
{
    public function randomNumber(int $min, int $max): int
    {
        return rand($min, $max);
    }

    public function randomArrayItem(array $array): mixed
    {
        return $array[array_rand($array)];
    }
}
