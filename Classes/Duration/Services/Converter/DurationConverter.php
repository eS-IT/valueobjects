<?php

/**
 * @since       11.03.2024 - 11:09
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

use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\HourValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\MinuteValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\SecondValue;

class DurationConverter
{


    /**
     * Konvertiert ein Hours-Objekt in einen String.
     *
     * @param HourValue $time
     *
     * @return string
     */
    public function convertToFormatedHours(HourValue $time): string
    {
        $hours   = $time->count();

        return $hours < 10 ? "0$hours" : (string) $hours;
    }


    /**
     * Konvertiert ein Minutes-Objekt in einen String.
     *
     * @param MinuteValue $time
     *
     * @return string
     */
    public function convertToFormatedMinutes(MinuteValue $time): string
    {
        $minutes = $time->count();

        return $minutes < 10 ? "0$minutes" : (string) $minutes;
    }


    /**
     * Konvertiert ein Seconds-Objekt in einen String.
     *
     * @param SecondValue $time
     *
     * @return string
     */
    public function convertToFormatedSeconds(SecondValue $time): string
    {
        $seconds = $time->value();

        return $seconds < 10 ? "0$seconds" : (string) $seconds;
    }


    /**
     * Konvertiert die Objekte in einen Zeitstring für die Ausgabe.
     *
     * @param DurationValue $time
     * @param string        $format
     *
     * @return string
     */
    public function convertToFormatedString(DurationValue $time, string $format, string $prefix = '-'): string
    {
        $search     = ['H', 'i', 's'];
        $prefix     = $time->isNegativ() ? $prefix : '';
        $replace    = [
            $this->convertToFormatedHours($time->getHoursValue()),
            $this->convertToFormatedMinutes($time->getMinutesValue()),
            $this->convertToFormatedSeconds($time->getSecondsValue())
        ];

        return $prefix . \str_replace($search, $replace, $format);
    }
}
