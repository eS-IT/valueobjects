<?php

/**
 * @package   valueobjects
 * @since     08.08.2022 - 10:52
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Url\Valueobjects;

use Esit\Valueobjects\Classes\Url\Exceptions\NotAValidUrlException;
use Esit\Valueobjects\Classes\Url\Services\Validators\UrlValidator;

class UrlValue implements \Stringable
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
     * Erstellt ein Obejekt aus einem String.
     * @param string       $value
     * @param UrlValidator $validator
     * @param bool         $forceSchema
     * @param string       $schema
     * @return self
     */
    public static function fromString(
        string $value,
        UrlValidator $validator,
        bool $forceSchema = false,
        string $schema = ''
    ): self {
        if (!$validator->isValid($value, $forceSchema, $schema)) {
            throw new NotAValidUrlException('string is not a valid url');
        }

        return new self($value);
    }


    /**
     * Gibt den Wert zurück.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


    /**
     * Gibt den Wert aus.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
