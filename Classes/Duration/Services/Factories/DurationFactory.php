<?php

/**
 * @since       11.03.2024 - 11:10
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Services\Factories;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\HourValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\MinuteValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\SecondValue;

class DurationFactory
{


    /**
     * @param DurationCalculator $calculator
     * @param DurationConverter  $converter
     * @param DurationDivider    $divider
     */
    public function __construct(
        private readonly DurationCalculator $calculator,
        private readonly DurationConverter $converter,
        private readonly DurationDivider $divider
    ) {
    }


    /**
     * Gibt ein Duration-Objekt zurück.
     *
     * @param int $time
     *
     * @return DurationValue
     */
    public function createDurationFromInt(int $time): DurationValue
    {
        return new DurationValue($time, $this, $this->calculator, $this->converter);
    }


    /**
     * Gibt ein Wertobjekt für den Stundenanteil der Zeit zurück.
     *
     * @param int $time
     *
     * @return HourValue
     */
    public function createHourFromInt(int $time): HourValue
    {
        return new HourValue($time, $this->divider, $this->converter);
    }


    /**
     * Gibt ein Wertobjekt für den Minutenanteil der Zeit zurück.
     *
     * @param int $time
     *
     * @return MinuteValue
     */
    public function createMinuteFromInt(int $time): MinuteValue
    {
        return new MinuteValue($time, $this->divider, $this->converter);
    }


    /**
     * Gibt ein Wertobjekt für den Sekiundennanteil der Zeit zurück.
     *
     * @param int $time
     *
     * @return SecondValue
     */
    public function createSecondFromInt(int $time): SecondValue
    {
        return new SecondValue($time, $this->divider, $this->converter);
    }
}
