<?php

declare(strict_types=1);

namespace parkrunReporter\RunReport;

use parkrunReporter\Random\WeakRandom;
use parkrunReporter\Report\Attendance;
use parkrunReporter\Report\EventSummary;
use parkrunReporter\Report\FirstFemale;
use parkrunReporter\Report\FirstFinisher;
use parkrunReporter\Report\FirstMale;
use parkrunReporter\Report\Milestone;
use parkrunReporter\Report\FirstTimers;
use parkrunReporter\Report\MedianFinisher;
use parkrunReporter\Report\Nigel;
use parkrunReporter\Report\PersonalBest;
use parkrunReporter\Report\PersonalBestTime;
use parkrunReporter\Report\Time;
use parkrunReporter\RunReportFactoryInterface;
use parkrunReporter\RunReportInterface;
use parkrunScraper\ApiInterface;

/**
 * A run report factory.
 * An implementation that directly creates objects when used as a library without DI.
 */
class Factory implements RunReportFactoryInterface
{
    public function create(): RunReportInterface
    {
        // @todo Consider caching/pre-calculating things in the scraper to prevent all reports iterating.
        // Could extend it in the reporter and pre-calculate.
        $parkrunScraper = (new \parkrunScraper\Api\Factory())->create();

        return new RunReport(
            (function (ApiInterface $parkrunScraper): \Generator {
                yield new EventSummary($parkrunScraper);
                yield new Attendance($parkrunScraper);
                yield new FirstFinisher($parkrunScraper);
                yield new FirstMale($parkrunScraper);
                yield new FirstFemale($parkrunScraper);
                yield new MedianFinisher($parkrunScraper);
                yield new Time($parkrunScraper);
                yield new PersonalBest($parkrunScraper);
                yield new PersonalBestTime($parkrunScraper);
                yield new FirstTimers($parkrunScraper);
                yield new Milestone\First($parkrunScraper);
                yield new Milestone\Fifty($parkrunScraper);
                yield new Milestone\Hundred($parkrunScraper);
                yield new Milestone\TwoFifty($parkrunScraper);
                yield new Milestone\FiveHundred($parkrunScraper);
                yield new Nigel($parkrunScraper);
            })(
                $parkrunScraper
            ),
            new WeakRandom()
        );
    }
}
