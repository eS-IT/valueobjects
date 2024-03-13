<?php

/**
 * @since       11.03.2024 - 11:08
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Services\Calculators;

class DurationCalculator
{


    /**
     * Gibt das Ergebnis einer Addition zurück.
     *
     * @param int $timeOne
     * @param int $timeTwo
     *
     * @return int
     */
    public function add(int $timeOne, int $timeTwo): int
    {
        return $timeOne + $timeTwo;
    }


    /**
     * Gibt das Ergebnis einer Division zurück.
     *
     * @param int $timeOne
     * @param int $operand
     *
     * @return float|int
     */
    public function divide(int $timeOne, int $operand): float|int
    {
        return $timeOne / $operand;
    }


    /**
     * Gibt den absoluten Betrag der Dauer zurück.
     *
     * @param int $time
     *
     * @return int
     */
    public function getAbsoluteTime(int $time): int
    {
        return \abs($time);
    }


    /**
     * Gibt das Ergebnis einer Miltiplikation zurück.
     *
     * @param int $timeOne
     * @param int $operand
     *
     * @return int
     */
    public function multiply(int $timeOne, int $operand): int
    {
        return $timeOne * $operand;
    }


    /**
     * Gibt den Rest einer Division zurück.
     *
     * @param int $timeOne
     * @param int $operand
     *
     * @return int
     */
    public function modulo(int $timeOne, int $operand): int
    {
        return $timeOne % $operand;
    }


    /**
     * Gibt das Ergebnis einer Substraktion zurück.
     *
     * @param int $timeOne
     * @param int $timeTwo
     *
     * @return int
     */
    public function subtract(int $timeOne, int $timeTwo): int
    {
        return $timeOne - $timeTwo;
    }
}
