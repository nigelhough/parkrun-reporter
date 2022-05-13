<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class Attendance implements ReportableInterface
{
    public function __construct(private ApiInterface $api)
    {
    }

    public function getVariances(): array
    {
        return ['a', 'b', 'c'];
    }

    public function report(string $location, string $event, string $variance): ?ReportInterface
    {
        if (!in_array($variance, $this->getVariances())) {
            throw new InvalidVarianceException("Invalid variance supplied for report '{$variance}'.");
        }
        $summary = $this->api->getEventSummary($location, $event);

        return new Report(
            $variance,
            match ($variance) {
                'a' => "There were {$summary->getResults()->count()} runners.",
                'b' => "{$summary->getResults()->count()} eager parkrunners were up bright and early to take part.",
                'c' => "{$summary->getResults()->count()} lined up to walk, run or jog 5k.",
            }
        );
    }
}
