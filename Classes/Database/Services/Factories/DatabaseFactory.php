<?php

/**
 * @since       07.09.2024 - 11:44
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Database\Services\Factories;

use Esit\Valueobjects\Classes\Database\Services\Validators\DatabasenameValidator;
use Esit\Valueobjects\Classes\Database\Services\Validators\FieldnameValidator;
use Esit\Valueobjects\Classes\Database\Services\Validators\TablenameValidator;
use Esit\Valueobjects\Classes\Database\Valueobjects\DatabasenameValue;
use Esit\Valueobjects\Classes\Database\Valueobjects\FieldnameValue;
use Esit\Valueobjects\Classes\Database\Valueobjects\TablenameValue;

class DatabaseFactory
{


    /**
     * @param DatabasenameValidator $databasenameValidator
     * @param FieldnameValidator    $fieldnameValidator
     * @param TablenameValidator    $tablenameValidator
     */
    public function __construct(
        private readonly DatabasenameValidator $databasenameValidator,
        private readonly FieldnameValidator $fieldnameValidator,
        private readonly TablenameValidator $tablenameValidator
    ) {
    }


    /**
     * Erstellt ein DatabasenameValue.
     *
     * @param string $databasename
     *
     * @return DatabasenameValue
     *
     * @throws \Doctrine\DBAL\Exception
     */
    public function createDatabasenameFromString(string $databasename): DatabasenameValue
    {
        return DatabasenameValue::fromString($databasename, $this->databasenameValidator);
    }


    /**
     * Erstellt ein FieldnameValue.
     *
     * @param string                $fieldname
     * @param string|TablenameValue $tablename
     *
     * @return FieldnameValue
     *
     * @throws \Doctrine\DBAL\Exception
     */
    public function createFieldnameFromString(string $fieldname, string|TablenameValue $tablename): FieldnameValue
    {
        if (true === \is_string($tablename)) {
            $tablename = $this->createTablenameFromString($tablename);
        }

        return FieldnameValue::fromString($fieldname, $tablename, $this->fieldnameValidator);
    }


    /**
     * Erzeugt ein TablenameValue.
     *
     * @param string $tablename
     *
     * @return TablenameValue
     *
     * @throws \Doctrine\DBAL\Exception
     */
    public function createTablenameFromString(string $tablename): TablenameValue
    {
        return TablenameValue::fromString($tablename, $this->tablenameValidator);
    }
}
