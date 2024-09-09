<?php

/**
 * @since       09.09.2024 - 07:16
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

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;

class SchemaManagerFactory
{


    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection)
    {
    }


    /**
     * Erzeugt einen SchemaManager.
     *
     * @return AbstractSchemaManager
     *
     * @throws \Doctrine\DBAL\Exception
     *
     * @phpstan-ignore-next-line
     */
    public function getSchemaManager(): AbstractSchemaManager
    {
        if (\method_exists($this->connection, 'createSchemaManager')) {
            return $this->connection->createSchemaManager();
        }

        // Fallback für Contao 4.*
        return $this->connection->getSchemaManager();
    }
}
