<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportInterface;

class Report implements ReportInterface
{
    public function __construct(private string $variance, private string $report)
    {
    }

    public function __toString(): string
    {
        return $this->report;
    }

    public function getVariance(): string
    {
        return $this->variance;
    }

    public function report(): string
    {
        return $this->report;
    }
}
