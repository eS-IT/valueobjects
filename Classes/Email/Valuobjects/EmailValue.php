<?php

/**
 * @since     08.08.2022 - 15:49
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Email\Valuobjects;

use Esit\Valueobjects\Classes\Email\Exceptions\NotAValidEmailException;
use Esit\Valueobjects\Classes\Email\Services\Validators\EmailValidator;

class EmailValue
{
    /**
     * @var string
     */
    private string $value;


    /**
     * @param string $value
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }


    /**
     * Erzeugt aus einem String ein EmailValue-Objekt.
     *
     * @param string         $value
     * @param EmailValidator $validator
     *
     * @return self
     */
    public static function fromString(string $value, EmailValidator $validator): self
    {
        if (!$validator->isValid($value)) {
            throw new NotAValidEmailException('string is not a valid email');
        }

        return new self($value);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
