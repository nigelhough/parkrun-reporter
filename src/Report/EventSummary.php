<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;

class EventSummary implements ReportableInterface
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

        return new Report(
            $variance,
            "The {$summary->getEvent()->getLocation()->getName()} event number {$summary->getEvent()->getNumber()} on {$summary->getEvent()->getDate()->format('jS F Y')}."
        );
    }
}
