#!/usr/bin/env php
<?php

/**
 * A CLI interface to the parkrun Reporter.
 * Used for generating parkrun reports.
 */
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

// CLI Options.
$options = getopt("l::e::");
$location = (string) ($options['l'] ?? 'miltonkeynes');
$event = (string) ($options['e'] ?? 'latestresults');

try {
    $runReport = (new \parkrunReporter\RunReport\Factory())->create();
    echo "\n";
    foreach ($runReport->generate($location, $event) as $report) {
        echo $report . "\n";
    }
    echo "\n\n";
} catch (\Throwable $e) {
    echo $e->getMessage();
    exit(1);
}
exit(0);
