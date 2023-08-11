<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

use parkrunReporter\ReportableInterface;
use parkrunReporter\ReportInterface;
use parkrunScraper\ApiInterface;
use parkrunScraper\Athlete\Athlete;

class PersonalBestTime implements ReportableInterface
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

        $thisWeek = $this->api->getEventSummary($location, $event);
        if ($thisWeek->getEvent()->getNumber() === 1) {
            return null;
        }
        $lastWeek = $this->api->getEventSummary($location, (string) ($thisWeek->getEvent()->getNumber() - 1));

        $personalBestResults = [];
        foreach ($thisWeek->getResults()->iterate() as $result) {
            $isPB = $result->getAchievements() === 'New PB!';
            if ($isPB) {
                $personalBestResults[$result->getAthlete()->getId()] = [
                    'athlete' => $result->getAthlete(),
                    'personalBest' => $result->getTime()->getSeconds(),
                ];
            }
        }
        $largestImprovement = 0;
        $athletes = [];
        foreach ($lastWeek->getResults()->iterate() as $result) {
            if (isset($personalBestResults[$result->getAthlete()->getId()])) {
                $previousTime = $result->getTime()->getSeconds();
                $personalBestTime = $personalBestResults[$result->getAthlete()->getId()]['personalBest'];
                $improvement = $previousTime - $personalBestTime;
                if ($improvement > $largestImprovement) {
                    $largestImprovement = $improvement;
                    $athletes = [$result->getAthlete()];
                } elseif ($improvement === $largestImprovement) {
                    $athletes[] = $result->getAthlete();
                }
            }
        }

        if (empty($athletes)) {
            return null;
        }

        $athletes = implode(
            ', ',
            array_map(function (Athlete $athlete): string {
                return $athlete->getName();
            }, $athletes)
        );
        return new Report(
            $variance,
            "{$athletes} improved their personal best shaving {$largestImprovement} seconds off."
        );
    }
}
