<?php

declare(strict_types=1);

namespace parkrunReporter\Report\Milestone;

class TwoFifty extends AbstractMilestone
{
    protected function isMilestone(int $number): bool
    {
        return ($number === 250);
    }

    protected function getMilestoneName(): string
    {
        return 'Two Hundred and Fiftyth';
    }
}
