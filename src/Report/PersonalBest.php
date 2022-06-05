<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class PersonalBest implements ReportableInterface
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
        $count = 0;
        foreach ($summary->getResults()->iterate() as $result) {
            $isPB = $result->getAchievements() === 'New PB!';
            $count += (int) $isPB;
        }

        if ($count === 0) {
            return null;
        }

        return new Report(
            $variance,
            "{$count} runner's achieved a personal best this week."
        );
    }
}
