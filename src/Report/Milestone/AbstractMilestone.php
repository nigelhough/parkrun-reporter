<?php

declare(strict_types=1);

namespace parkrunReporter\Report\Milestone;

use parkrunReporter\Report\InvalidVarianceException;
use parkrunReporter\Report\Report;
use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

abstract class AbstractMilestone implements ReportableInterface
{
    public function __construct(private ApiInterface $api)
    {
    }

    public function getVariances(): array
    {
        return ['a'];
    }

    abstract protected function isMilestone(int $number): bool;

    abstract protected function getMilestoneName(): string;

    public function report(string $location, string $event, string $variance): ?ReportInterface
    {
        if (!in_array($variance, $this->getVariances())) {
            throw new InvalidVarianceException("Invalid variance supplied for report '{$variance}'.");
        }

        $summary = $this->api->getEventSummary($location, $event);
        $count = 0;
        foreach ($summary->getResults()->iterate() as $result) {
            $count += (int) $this->isMilestone($result->getAthlete()->getRuns());
        }

        if ($count === 0) {
            return null;
        }

        return new Report(
            $variance,
            "{$count} runners did their {$this->getMilestoneName()} parkrun."
        );
    }
}
