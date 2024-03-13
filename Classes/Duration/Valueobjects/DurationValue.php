<?php

/**
 * @since       11.03.2024 - 11:11
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Valueobjects;

use Esit\Valueobjects\Classes\Duration\Interfaces\FormatableInterface;
use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;

class DurationValue implements FormatableInterface
{


    /**
     * @var int
     */
    private int $time;


    /**
     * @var bool
     */
    private bool $isNegativ;


    /**
     * @param int                $time
     * @param DurationFactory    $factory
     * @param DurationCalculator $calculator
     * @param DurationConverter  $converter
     */
    public function __construct(
        int $time,
        private readonly DurationFactory $factory,
        private readonly DurationCalculator $calculator,
        private readonly DurationConverter $converter
    ) {
        $this->isNegativ    = $time < 0;
        $this->time         = $this->calculator->getAbsoluteTime($time);
    }


    /**
     * Gibt die Zeit im Stardardformat aus.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->parse();
    }


    /**
     * Gibt den Wert in Sekunden zurück.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->time;
    }


    /**
     * @return bool
     */
    public function isNegativ(): bool
    {
        return $this->isNegativ;
    }


    /**
     * Gibt die formatierte Zeit zurück.
     * (Wrapper für Converter)
     *
     * @param string $format
     * @param string $prefix
     *
     * @return string
     */
    public function parse(string $format = 'H:i:s', string $prefix = '-'): string
    {
        return $this->converter->convertToFormatedString($this, $format, $prefix);
    }


    /**
     * Gibt ein Wertobjekt für die Stunden zurück.
     *
     * @return HourValue
     */
    public function getHoursValue(): HourValue
    {
        return $this->factory->createHourFromInt($this->time);
    }


    /**
     * Gibt die ganzen Minuten zurück.
     *
     * @return MinuteValue
     */
    public function getMinutesValue(): MinuteValue
    {
        return $this->factory->createMinuteFromInt($this->time);
    }


    /**
     * Gibt die Anzahl der Sekunden zurück, nach dem Stunden und Minuten abgezoegen wurden.
     *
     * @return SecondValue
     */
    public function getSecondsValue(): SecondValue
    {
        return $this->factory->createSecondFromInt($this->time);
    }


    /**
     * Addiert ein DurationValue.
     *
     * @param DurationValue $durationValue
     *
     * @return DurationValue
     */
    public function add(self $durationValue): self
    {
        $value = $this->calculator->add($this->value(), $durationValue->value());

        return $this->factory->createDurationFromInt($value);
    }


    /**
     * Subtraiert ein DurationValue.
     *
     * @param DurationValue $durationValue
     *
     * @return DurationValue
     */
    public function subtract(self $durationValue): self
    {
        $value = $this->calculator->subtract($this->value(), $durationValue->value());

        return $this->factory->createDurationFromInt($value);
    }


    /**
     * Multipliziert dieses DurationValue mit einem Operanden
     * und gibt das Ergebnis als DurationValue zurück.
     *
     * @param int $operand
     *
     * @return DurationValue
     */
    public function multiply(int $operand): self
    {
        $value = $this->calculator->multiply($this->value(), $operand);

        return $this->factory->createDurationFromInt($value);
    }


    /**
     * Dividiert dieses DuraitionValue durch einen Operanden
     * und gibt das Ergebnis als ein DurationValue zurück.
     *
     * @param int $operand
     *
     * @return DurationValue
     */
    public function divide(int $operand): self
    {
        $value = (int) $this->calculator->divide($this->value(), $operand);

        return $this->factory->createDurationFromInt($value);
    }
}
