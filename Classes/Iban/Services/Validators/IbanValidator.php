<?php

/**
 * @package   valueobjects
 * @since     09.08.2022 - 09:38
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Iban\Services\Validators;

class IbanValidator
{
    /**
     * Regulärer Ausdruck für die IP-Adresse.
     *
     * @see https://www.regextester.com/115565
     */
    private const RGXP_IP = '/^(?:(?:IT|SM)\d{2}[A-Z]\d{22}|CY\d{2}[A-Z]\d{23}|NL\d{2}[A-Z]{4}\d{10}|LV\d{2}[A-Z]{4}' .
                            '\d{13}|(?:BG|BH|GB|IE)\d{2}[A-Z]{4}\d{14}|GI\d{2}[A-Z]{4}\d{15}|RO\d{2}[A-Z]{4}\d{16}|' .
                            'KW\d{2}[A-Z]{4}\d{22}|MT\d{2}[A-Z]{4}\d{23}|NO\d{13}|(?:DK|FI|GL|FO)\d{16}|MK\d{17}|' .
                            '(?:AT|EE|KZ|LU|XK)\d{18}|(?:BA|HR|LI|CH|CR)\d{19}|(?:GE|DE|LT|ME|RS)\d{20}|IL\d{21}|' .
                            '(?:AD|CZ|ES|MD|SA)\d{22}|PT\d{23}|(?:BE|IS)\d{24}|(?:FR|MR|MC)\d{25}|(?:AL|DO|LB|PL)' .
                            '\d{26}|(?:AZ|HU)\d{27}|(?:GR|MU)\d{28})$/';


    /**
     * @param  string $value
     * @return bool
     */
    public function isValid(string $value): bool
    {
        return 1 === \preg_match(self::RGXP_IP, $value);
    }
}
