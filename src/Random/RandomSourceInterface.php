<?php

namespace parkrunReporter\Random;

/**
 * Describes a source of random data,
 */
interface RandomSourceInterface
{
    public function randomNumber(int $min, int $max): int;

    public function randomArrayItem(array $array): mixed;
}
