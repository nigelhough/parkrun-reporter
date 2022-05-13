<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class MedianFinisher implements ReportableInterface
{
    public function __construct(private ApiInterface $api)
    {
    }

    public function getVariances(): array
    {
        return ['a'];
    }

    public function report(string $location, string $event, string $variance): ?ReportInterface
    {
        if (!in_array($variance, $this->getVariances())) {
            throw new InvalidVarianceException("Invalid variance supplied for report '{$variance}'.");
        }
        $summary = $this->api->getEventSummary($location, $event);
        $median = null;
        $medianPosition = (int) floor($summary->getResults()->count() / 2);
        foreach ($summary->getResults()->iterate() as $result) {
            if ($result->getPosition() === $medianPosition) {
                $median = $result;
            }
        }

        return new Report(
            $variance,
            "{$median->getAthlete()->getName()} was the median position runner at position {$median->getPosition()}, past the post with a time of {$median->getTime()}."
        );
    }
}
