<?php

namespace parkrunReporter;

/**
 * Describes a parkrun report for an event.
 */
interface RunReportInterface
{
    /**
     * @return \Generator|ReportInterface[]
     */
    public function generate(string $location, string $event): \Generator;
}
