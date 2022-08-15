<?php

/**
 * @package   valueobjects
 * @since     06.08.2022 - 10:12
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Isbn\Valueobjects;

use Esit\Valueobjects\Classes\Isbn\Exceptions\NotAValidIsbnStringException;
use Esit\Valueobjects\Classes\Isbn\Services\Validators\IsbnValidator;

class Isbn13Value implements \Stringable
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
     * @param  string        $value
     * @param  IsbnValidator $validator
     * @return static
     */
    public static function fromString(string $value, IsbnValidator $validator): self
    {
        if (!$validator->isValidIsbn13($value) || !$validator->validateCheckSum13($value)) {
            throw new NotAValidIsbnStringException('string is no valid isbn13');
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


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
