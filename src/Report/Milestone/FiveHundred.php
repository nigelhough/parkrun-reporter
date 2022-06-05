<?php

declare(strict_types=1);

namespace parkrunReporter\Report\Milestone;

class FiveHundred extends AbstractMilestone
{
    protected function isMilestone(int $number): bool
    {
        return ($number === 500);
    }

    protected function getMilestoneName(): string
    {
        return 'Five Hundredth';
    }
}
