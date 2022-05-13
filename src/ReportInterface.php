<?php

declare(strict_types=1);

namespace parkrunReporter;

/**
 * Describes a parkrun report.
 */
interface ReportInterface extends \Stringable
{
    public function getVariance(): string;

    public function report(): string;
}
