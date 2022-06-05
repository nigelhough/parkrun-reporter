<?php

declare(strict_types=1);

namespace parkrunReporter\Report\Milestone;

class First extends AbstractMilestone
{
    protected function isMilestone(int $number): bool
    {
        return ($number === 1);
    }

    protected function getMilestoneName(): string
    {
        return 'First';
    }
}
