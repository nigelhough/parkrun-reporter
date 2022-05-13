<?php

namespace parkrunReporter;

/**
 * Describes a factory able to build a run report.
 */
interface RunReportFactoryInterface
{
    public function create(): RunReportInterface;
}
