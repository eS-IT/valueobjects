<?php

/**
 * @package   valueobjects
 * @since     08.08.2022 - 15:47
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Email\Services\Factories;

use Esit\Valueobjects\Classes\Email\Services\Validators\EmailValidator;
use Esit\Valueobjects\Classes\Email\Valuobjects\EmailValue;

class EmailFactory
{
    /**
     * @var EmailValidator
     */
    private EmailValidator $validator;


    /**
     * @param EmailValidator $validator
     */
    public function __construct(EmailValidator $validator)
    {
        $this->validator = $validator;
    }


    /**
     * Erstellt aus einem String ein E-Mail-Objekt.
     *
     * @param  string $value
     * @return EmailValue
     */
    public function createFromString(string $value): EmailValue
    {
        return EmailValue::fromString($value, $this->validator);
    }
}
