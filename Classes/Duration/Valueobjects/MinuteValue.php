<?php

/**
 * @since       11.03.2024 - 16:02
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

use Esit\Valueobjects\Classes\Duration\Interfaces\CountableInterface;
use Esit\Valueobjects\Classes\Duration\Interfaces\FormatableInterface;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;

class MinuteValue implements CountableInterface, FormatableInterface
{


    /**
     * @var int
     */
    private int $time;


    /**
     * @param int               $time
     * @param DurationDivider   $divider
     * @param DurationConverter $converter
     */
    public function __construct(
        int $time,
        private readonly DurationDivider $divider,
        private readonly DurationConverter $converter
    ) {
        $this->time = $this->divider->getScondsOfMinutes($time);
    }


    /**
     * Gibt die ganzen Minuten zurück.
     * (Wrapper für Divider)
     *
     * @return int
     */
    public function count(): int
    {
        return $this->divider->getMinutesCount($this->time);
    }


    /**
     * Gibt die Anzahl der Sekunden der ganzen Minuten zurück.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->time;
    }


    /**
     * Gibt die Anzahl der Minuten als String zurück.
     * Ist die Anzahl kleiner 10, wird eine führende Null angefügt.
     * (Wrapper für Converter)
     *
     * @return string
     */
    public function parse(): string
    {
        return $this->converter->convertToFormatedMinutes($this);
    }
}
