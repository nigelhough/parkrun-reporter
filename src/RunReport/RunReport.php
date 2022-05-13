<?php

declare(strict_types=1);

namespace parkrunReporter\RunReport;

use parkrunReporter\Random\RandomSourceInterface;
use parkrunReporter\ReportableInterface;
use parkrunReporter\RunReportInterface;

class RunReport implements RunReportInterface
{
    /**
     * @param \Generator|ReportableInterface[] $reports
     */
    public function __construct(private \Generator $reports, private RandomSourceInterface $random)
    {
    }

    public function generate(string $location, string $event): \Generator
    {
        foreach ($this->reports as $report) {
            $result = $report->report($location, $event, $this->random->randomArrayItem($report->getVariances()));
            if ($result === null) {
                continue;
            }
            yield $result;
        }
    }
}
