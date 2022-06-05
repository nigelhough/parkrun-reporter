<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class Nigel implements ReportableInterface
{
    public const NIGEL_RUNNER_ID = 960984;

    public function __construct(private ApiInterface $api)
    {
    }

    public function getVariances(): array
    {
        return ['a', 'b'];
    }

    public function report(string $location, string $event, string $variance): ?ReportInterface
    {
        if (!in_array($variance, $this->getVariances())) {
            throw new InvalidVarianceException("Invalid variance supplied for report '{$variance}'.");
        }
        $summary = $this->api->getEventSummary($location, $event);
        foreach ($summary->getResults()->iterate() as $result) {
            if ($result->getAthlete()->getId() === self::NIGEL_RUNNER_ID) {
                return new Report(
                    $variance,
                    match ($variance) {
                        'b' => "Nigel was here",
                        default => 'Nigel ran at this event!'
                    }
                );
            }
        }

        return new Report(
            $variance,
            "Nigel did not run at this event."
        );
    }
}
