<?php

/**
 * @since       11.03.2024 - 13:15
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Services\Converter;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;

class DurationConverter
{


    /**
     * @param DurationCalculator $calculator
     */
    public function __construct(private readonly DurationCalculator $calculator)
    {
    }


    /**
     * Gibt die Anzahl einer Einheit (z. B. Minuten, Stunden, Tage, usw.)
     * OHNE dem Anteil aller übergeordneten Einheiten zurück.
     * (Beipsiel: bei 26 Stunden, werden 2 Stunden zurückgegeben, der der Rest 1 Tag ergbit.)
     *
     * @param int $time
     * @param int $conversionFactor
     * @param int $conversionFactorParentUnit
     *
     * @return int
     */
    public function getCountOfUnit(int $time, int $conversionFactor, int $conversionFactorParentUnit): int
    {
        $secondsOfParentUnit    = $this->getSecondsOfUnit($time, $conversionFactorParentUnit);
        $time                   = $this->calculator->subtract($time, $secondsOfParentUnit);

        return $this->getTotalAmountOfUnit($time, $conversionFactor);
    }


    /**
     * Gibt die Gesamtzahl einer Einheit (z. B. Minuten, Stunden, Tage, usw.)
     * MIT dem Anteil aller übergeordneten Einheiten zurück.
     * (Beipsiel: 26 Stunden, statt 1 Tag, 2 Stunden)
     *
     * @param int $time
     * @param int $conversionFactor
     *
     * @return int
     */
    public function getTotalAmountOfUnit(int $time, int $conversionFactor): int
    {
        $time = $this->getSecondsOfUnit($time, $conversionFactor);

        return (int) $this->calculator->divide($time, $conversionFactor);
    }


    /**
     * Gibt die Anzahl einer Einheit (z. B. Minuten, Stunden, Tage, usw.) ohne den Dezimalteil an.
     *
     * @param int $time
     * @param int $conversionFactor
     *
     * @return int
     */
    public function getSecondsOfUnit(int $time, int $conversionFactor): int
    {
        $rest = $this->getRestOfUnit($time, $conversionFactor);

        return $this->calculator->subtract($time, $rest);
    }


    /**
     * Gibt den Dezimalanteil einer Einheit (z. B. Minuten, Stunden, Tage, usw.) zurück.
     *
     * @param int $time
     * @param int $conversionFactor
     *
     * @return int
     */
    public function getRestOfUnit(int $time, int $conversionFactor): int
    {
        return $this->calculator->modulo($time, $conversionFactor);
    }
}
