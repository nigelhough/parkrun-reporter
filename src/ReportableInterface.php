<?php

namespace parkrunReporter;

/**
 * Describes something that can be reported upon in a parkrun report.
 */
interface ReportableInterface
{
    public function getVariances(): array;

    /**
     * @return ReportInterface|null Returns a report or null if a report can't be produced.
     */
    public function report(string $location, string $event, string $variance): ?ReportInterface;
}
