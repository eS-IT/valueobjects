<?php

/**
 * @package   valueobjects
 * @since     21.07.22 - 17:32
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Services\Factories;

use Esit\Valueobjects\Classes\Money\Services\Converter\MoneyConverter;
use Esit\Valueobjects\Classes\Money\Services\Calculator\MoneyCalculator;
use Esit\Valueobjects\Classes\Money\Services\Validators\MoneyValidator;
use Esit\Valueobjects\Classes\Money\Valueobjects\MoneyValue;

class MoneyFactory
{
    /**
     * @var MoneyConverter
     */
    private MoneyConverter $converter;


    /**
     * @var MoneyValidator
     */
    private MoneyValidator $validator;


    /**
     * @var MoneyCalculator
     */
    private MoneyCalculator $calculator;


    /**
     * MoneyFactory constructor.
     *
     * @param MoneyConverter  $converter
     * @param MoneyValidator  $validator
     * @param MoneyCalculator $calculator
     */
    public function __construct(MoneyConverter $converter, MoneyValidator $validator, MoneyCalculator $calculator)
    {
        $this->converter  = $converter;
        $this->validator  = $validator;
        $this->calculator = $calculator;
    }


    /**
     * Erstellt aus einem String mit zwei Nachkommastellen ein MoneyValue-Objekt.
     *
     * @param string $value
     * @param string $separator
     * @param string $decimal
     * @param int    $decimalPlaces
     * @return MoneyValue
     */
    public function createFromString(
        string $value,
        string $separator = '.',
        string $decimal = ',',
        int $decimalPlaces = 2
    ): MoneyValue {
        return MoneyValue::fromString(
            $value,
            $this->converter,
            $this->validator,
            $this->calculator,
            $separator,
            $decimal,
            $decimalPlaces
        );
    }


    /**
     * Erstellt aus einem Centbetrag ein MoneyValue-Objekt.
     *
     * @param int $value
     * @param int $decimalPlaces
     * @return MoneyValue
     */
    public function createFromInt(int $value, int $decimalPlaces = 2): MoneyValue
    {
        return MoneyValue::fromInt($value, $this->converter, $this->calculator, $decimalPlaces);
    }
}
