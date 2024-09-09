<?php

/**
 * @since       07.09.2024 - 11:49
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Database\Services\Validators;

use Doctrine\DBAL\Connection;

class DatabasenameValidator
{


    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection)
    {
    }


    /**
     * Prüft, ob die Datenbank mit dem übergebenen Namen existiert.
     *
     * @param string $databaseName
     *
     * @return bool
     *
     * @throws \Doctrine\DBAL\Exception
     */
    public function validate(string $databaseName): bool
    {
        $databases = $this->connection->createSchemaManager()->listDatabases() ?: [];

        return \in_array($databaseName, $databases, true);
    }
}
