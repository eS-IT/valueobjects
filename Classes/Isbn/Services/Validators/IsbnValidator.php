<?php

/**
 * @since     06.08.2022 - 10:15
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Isbn\Services\Validators;

class IsbnValidator
{
    /**
     * Regularer Ausdruck für eine ISBN13
     */
    private const RGXP_ISBN_13 = '/^(97(?:8|9)(-?)(?=\d{1,5}\2?\d{1,7}\2?\d{1,6}\2?\d)(?:\d\2*){9}\d)$/';


    /**
     * Regularer Ausdruck für eine ISBN10
     */
    private const RGXP_ISBN_10 = '/^((?=\d{1,5}(-?)\d{1,7}\2?\d{1,6}\2?\d)(?:\d\2*){9}[\dX])$/';


    /**
     * Prüft, ob der übergebene String eine valide ISBN13 ist.
     *
     * @param string $value
     *
     * @return bool
     */
    public function isValidIsbn13(string $value): bool
    {
        return 1 === \preg_match(self::RGXP_ISBN_13, $value);
    }


    /**
     * Prüft, ob der übergebene String eine valide ISBN10 ist.
     *
     * @param string $value
     *
     * @return bool
     */
    public function isValidIsbn10(string $value): bool
    {
        return 1 === \preg_match(self::RGXP_ISBN_10, $value);
    }


    /**
     * Prüft die Prüfsumme der ISBN13
     *
     * @param string $value
     *
     * @return bool
     */
    public function validateCheckSum13(string $value): bool
    {
        $check = 0;
        $value = \str_replace('-', '', $value);

        if (13 !== \strlen($value)) {
            return false;
        }

        for ($i = 0; $i < 13; $i += 2) {
            $check += (int) $value[$i];
        }

        for ($i = 1; $i < 12; $i += 2) {
            $check += 3 * (int) $value[$i];
        }

        return 0 === $check % 10;
    }


    /**
     * Prüft die Prüfsumme der ISBN10
     *
     * @param string $value
     *
     * @return bool
     */
    public function validateCheckSum10(string $value): bool
    {
        $check = 0;
        $value = \str_replace('-', '', $value);

        if (10 !== \strlen($value)) {
            return false;
        }

        $checksum = \substr($value, -1);

        for ($i = 0; $i < 9; ++$i) {
            $check += (int) $value[$i] * ($i + 1);
        }

        if ('X' === \strtoupper($checksum)) {
            return 10 === $check % 11;
        }

        return $check % 11 === (int) $checksum;
    }
}
