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

class TablenameValidator
{


    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection)
    {
    }


    /**
     * Pürft, ob eine Tabelle mit dem übergebenen Namen existiert.
     *
     * @param string $tablename
     *
     * @return bool
     *
     * @throws \Doctrine\DBAL\Exception
     */
    public function validate(string $tablename): bool
    {
        $tables = $this->connection->createSchemaManager()->listTableNames();

        return \in_array($tablename, $tables, true);
    }
}
