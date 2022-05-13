<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class FirstFemale implements ReportableInterface
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
        foreach ($summary->getResults()->iterate() as $result) {
            if ($result->getAthlete()->getGender() === 'Female') {
                return new Report(
                    $variance,
                    "{$result->getAthlete()->getName()} was the first female with a time of {$result->getTime()}."
                );
            }
        }

        // No Female?
        return null;
    }
}
