<?php

declare(strict_types=1);

namespace parkrunReporter\Report\Milestone;

class Hundred extends AbstractMilestone
{
    protected function isMilestone(int $number): bool
    {
        return ($number === 100);
    }

    protected function getMilestoneName(): string
    {
        return 'Hundredth';
    }
}
