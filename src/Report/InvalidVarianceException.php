<?php

declare(strict_types=1);

namespace parkrunReporter\Report;

/**
 * An exception thrown when an invalid variance is given to a report.
 */
class InvalidVarianceException extends \InvalidArgumentException implements \parkrunReporter\ParkrunExceptionInterface
{
}