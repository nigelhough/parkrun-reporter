<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class Time implements ReportableInterface
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
        $totalTime = 0;
        foreach ($summary->getResults()->iterate() as $result) {
            $totalTime += $result->getTime()->getSeconds();
        }
        $medianTime = (int) ((int)$totalTime / $summary->getResults()->count());
        $medianTime = new \parkrunScraper\Result\Time\Time($medianTime);
        $totalTime = new \parkrunScraper\Result\Time\Time($totalTime);

        return new Report(
            $variance,
            "The total time of all runners was {$totalTime->getFormatted()} seconds with the median time being {$medianTime->getFormatted()} seconds."
        );
    }
}
