<?php

declare(strict_types=1);

namespace parkrunReporter\Report\Milestone;

class Fifty extends AbstractMilestone
{
    protected function isMilestone(int $number): bool
    {
        return ($number === 50);
    }

    protected function getMilestoneName(): string
    {
        return 'Fiftyth';
    }
}
