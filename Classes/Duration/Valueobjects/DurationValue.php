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

use Esit\Valueobjects\Classes\Duration\Interfaces\DurationCalculatorInterface;
use Esit\Valueobjects\Classes\Duration\Interfaces\DurationInterface;
use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;
use Esit\Valueobjects\Classes\Duration\Services\Parser\DurationParser;

class DurationValue implements DurationInterface, DurationCalculatorInterface
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
     * @param string             $format
     * @param string             $prefix
     * @param DurationFactory    $factory
     * @param DurationCalculator $calculator
     * @param DurationParser     $parser
     */
    public function __construct(
        int $time,
        private readonly string $format,
        private readonly string $prefix,
        private readonly DurationFactory $factory,
        private readonly DurationCalculator $calculator,
        private readonly DurationParser $parser
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
        return $this->parse($this->format, $this->prefix);
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
     *
     * @param string      $format
     * @param string|null $prefix
     *
     * @return string
     */
    public function parse(string $format, ?string $prefix = null): string
    {
        $prefix = $prefix ?? $this->prefix;

        return $this->parser->parseString($this, $format, $prefix);
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
