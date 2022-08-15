<?php

/**
 * @package   valueobjects
 * @since     21.07.22 - 17:44
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Services\Converter;

use Esit\Valueobjects\Classes\Money\Exceptions\MoneyIsEmptyException;
use Esit\Valueobjects\Classes\Money\Exceptions\NotAValidMoneyStringException;
use Esit\Valueobjects\Classes\Money\Services\Validators\MoneyValidator;

class MoneyConverter
{
    /**
     * @var MoneyValidator
     */
    protected $moneyValidator;


    /**
     * MoneyConverter constructor.
     *
     * @param MoneyValidator $val
     */
    public function __construct(MoneyValidator $val)
    {
        $this->moneyValidator = $val;
    }


    /**
     * Konvertier einen String mit einer Zahl mit zwei Nachkommastellen in den Centbetrag.
     *
     * @param  string $value
     * @param  string $thousandSeparator
     * @param  string $decimal
     * @return int
     */
    public function convertStringToInt(string $value, string $thousandSeparator = '.', string $decimal = ','): int
    {
        if ('' === $value) {
            throw new MoneyIsEmptyException('Money string can not be empty');
        }

        if (!$this->moneyValidator->isValidString($value, $thousandSeparator, $decimal)) {
            throw new NotAValidMoneyStringException('Parameter is not a valid money string');
        }

        return (int)\str_replace([$thousandSeparator, $decimal], '', $value);
    }


    /**
     * Konvertiert einen Centwert in eine Zahl mit zwei Nachkommastellen.
     *
     * @param int    $value
     * @param string $thousandSeparator
     * @param string $decimal
     * @param int    $decimalPlaces
     * @return string
     */
    public function convertIntToString(
        int $value,
        string $thousandSeparator = '.',
        string $decimal = ',',
        int $decimalPlaces = 2
    ): string {
        if (!$this->moneyValidator->isValidInt($value)) {
            throw new NotAValidMoneyStringException('Parameter is not a valid integer');
        }

        $divisor = (int)\str_pad('1', $decimalPlaces + 1, '0');

        return \number_format($value / $divisor, $decimalPlaces, $decimal, $thousandSeparator);
    }
}
