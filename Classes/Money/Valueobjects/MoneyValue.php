<?php

/**
 * @package   valueobjects
 * @since     21.07.22 - 17:35
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Valueobjects;

use Esit\Valueobjects\Classes\Money\Exceptions\NotAValidMoneyStringException;
use Esit\Valueobjects\Classes\Money\Services\Converter\MoneyConverter;
use Esit\Valueobjects\Classes\Money\Services\Calculator\MoneyCalculator;
use Esit\Valueobjects\Classes\Money\Services\Validators\MoneyValidator;

class MoneyValue implements \Stringable
{
    /**
     * Betrag in Eurocent
     *
     * @var int
     */
    private int $value;


    /**
     * Anzahl der Nachkommastellen.
     *
     * @var int
     */
    private int $decimalPlaces = 2;


    /**
     * @var MoneyConverter
     */
    private MoneyConverter $converter;


    /**
     * @var MoneyCalculator
     */
    private MoneyCalculator $calculator;


    /**
     * @param int             $value
     * @param MoneyConverter  $converter
     * @param MoneyCalculator $calculator
     * @param int             $decimalPlaces
     */
    protected function __construct(
        int $value,
        MoneyConverter $converter,
        MoneyCalculator $calculator,
        int $decimalPlaces = 2
    ) {
        $this->value            = $value;
        $this->converter        = $converter;
        $this->calculator       = $calculator;
        $this->decimalPlaces    = $decimalPlaces;
    }


    /**
     * Erzeugt aus einem String mit einer Zahl mit zwei Nachkommastellen ein MoneyValue-Objekt.
     * @param string          $value
     * @param MoneyConverter  $converter
     * @param MoneyValidator  $validator
     * @param MoneyCalculator $calculator
     * @param string          $thousandSeparator
     * @param string          $decimal
     * @param int             $decimalPlaces
     * @return self
     */
    public static function fromString(
        string $value,
        MoneyConverter $converter,
        MoneyValidator $validator,
        MoneyCalculator $calculator,
        string $thousandSeparator = '.',
        string $decimal = ',',
        int $decimalPlaces = 2
    ): self {
        if (!$validator->isValidString($value, $thousandSeparator, $decimal, $decimalPlaces)) {
            throw new NotAValidMoneyStringException('Value is no Valid money string');
        }

        $intValue = $converter->convertStringToInt($value, $thousandSeparator, $decimal);

        return new self($intValue, $converter, $calculator, $decimalPlaces);
    }


    /**
     * Erzeugt aus einer Zahl ein MoneyValue-Objekt.
     * @param int             $value
     * @param MoneyConverter  $converter
     * @param MoneyCalculator $calculator
     * @param int             $decimalPlaces
     * @return self
     */
    public static function fromInt(
        int $value,
        MoneyConverter $converter,
        MoneyCalculator $calculator,
        int $decimalPlaces = 2
    ): self {
        return new self($value, $converter, $calculator, $decimalPlaces);
    }


    /**
     * Wrapper für formatedValue().
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->formatedValue();
    }


    /**
     * Gibt einen String mit einer Zahl mit zwei Nachkommastellen zurück.
     *
     * @param string $thousandSeparator
     * @param string $decimal
     * @return string
     */
    public function formatedValue(
        string $thousandSeparator = '.',
        string $decimal = ','
    ): string {
        return $this->converter->convertIntToString($this->value, $thousandSeparator, $decimal, $this->decimalPlaces);
    }


    /**
     * Gibt den Integerwert zurück.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }


    /**
     * Gibt die Anzahl der Nachkommastellen zurück.
     *
     * @return int
     */
    public function getDecimalPlaces(): int
    {
        return $this->decimalPlaces;
    }


    /**
     * Addiert ein MoneyValue-Objekt zu diesem und gibt das neue zurück.
     *
     * @param  MoneyValue $money
     * @return MoneyValue
     */
    public function add(self $money): self
    {
        $value = $this->calculator->add($this, $money);

        return self::fromInt($value, $this->converter, $this->calculator);
    }


    /**
     * Subtrahiert ein MoneyValue-Objekt von diesem und gibt das neue zurück.
     *
     * @param  MoneyValue $money
     * @return MoneyValue
     */
    public function substract(self $money): self
    {
        $value = $this->calculator->substract($this, $money);

        return self::fromInt($value, $this->converter, $this->calculator);
    }


    /**
     * Multipliziert dieses MoneyValue-Objekt mit einer Zahl.
     *
     * @param  int $count
     * @return MoneyValue
     */
    public function multiply(int $count): self
    {
        $value = $this->calculator->multiply($this, $count);

        return self::fromInt($value, $this->converter, $this->calculator);
    }


    /**
     * Dividiert dieses MoneyValue-Objekt durch eine Zahl.
     *
     * @param  int $count
     * @return MoneyValue
     */
    public function divide(int $count): self
    {
        $value = $this->calculator->divide($this, $count);

        return self::fromInt($value, $this->converter, $this->calculator);
    }
}
