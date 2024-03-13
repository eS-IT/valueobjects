<?php

/**
 * @since     21.07.22 - 17:45
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Services\Calculator;

use Esit\Valueobjects\Classes\Money\Exceptions\DivisionByZeroException;
use Esit\Valueobjects\Classes\Money\Exceptions\NotSameDecimalPlacesException;
use Esit\Valueobjects\Classes\Money\Valueobjects\MoneyValue;

class MoneyCalculator
{
    /**
     * Addiert zwei MoneyValue-Objekte.
     *
     * @param MoneyValue $moneyOne
     * @param MoneyValue $moneyTwo
     *
     * @return int
     */
    public function add(MoneyValue $moneyOne, MoneyValue $moneyTwo): int
    {
        if ($moneyOne->getDecimalPlaces() !== $moneyTwo->getDecimalPlaces()) {
            throw new NotSameDecimalPlacesException('money objects must have the same decimal place count');
        }

        return $moneyOne->value() + $moneyTwo->value();
    }


    /**
     * Addiert zwei MoneyValue-Objekte.
     *
     * @param MoneyValue $moneyOne
     * @param MoneyValue $moneyTwo
     *
     * @return int
     */
    public function substract(MoneyValue $moneyOne, MoneyValue $moneyTwo): int
    {
        if ($moneyOne->getDecimalPlaces() !== $moneyTwo->getDecimalPlaces()) {
            throw new NotSameDecimalPlacesException('money objects must have the same decimal place count');
        }

        return $moneyOne->value() - $moneyTwo->value();
    }


    /**
     * Multipliziert ein MoneyValue-Objekt mit einer Zahl.
     *
     * @param MoneyValue $moneyOne
     * @param int        $count
     *
     * @return int
     */
    public function multiply(MoneyValue $moneyOne, int $count): int
    {
        return $moneyOne->value() * $count;
    }


    /**
     * Dividiert ein MoneyValue-Objekt durch eine Zahl.
     *
     * @param MoneyValue $moneyOne
     * @param int        $count
     *
     * @return int
     */
    public function divide(MoneyValue $moneyOne, int $count): int
    {
        if (0 === $count) {
            throw new DivisionByZeroException('division by zero not possible');
        }

        return (int) ($moneyOne->value() / $count);
    }
}
