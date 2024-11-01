<?php

/**
 * @since     06.08.2022 - 10:12
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Isbn\Valueobjects;

use Esit\Valueobjects\Classes\Isbn\Exceptions\NotAValidIsbnStringException;
use Esit\Valueobjects\Classes\Isbn\Services\Validators\IsbnValidator;

class Isbn10Value implements \Stringable
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
     * Erzeugt aus einem String ein Isbn10Value-Objekt.
     *
     * @param string        $value
     * @param IsbnValidator $validator
     *
     * @return self
     */
    public static function fromString(string $value, IsbnValidator $validator): self
    {
        if (!$validator->isValidIsbn10($value) || !$validator->validateCheckSum10($value)) {
            throw new NotAValidIsbnStringException('string is no valid isbn10');
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
