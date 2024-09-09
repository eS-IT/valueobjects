<?php

/**
 * @since       08.09.2024 - 16:57
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Database\Services\Validators;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Esit\Valueobjects\Classes\Database\Services\Validators\DatabasenameValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DatabasenameValidatorTest extends TestCase
{


    /**
     * @var (Connection&MockObject)|MockObject
     */
    private $connection;


    /**
     * @var (AbstractSchemaManager&MockObject)|MockObject
     */
    private $schemeManager;


    /**
     * @var DatabasenameValidator
     */
    private DatabasenameValidator $validator;


    protected function setUp(): void
    {
        $this->connection       = $this->getMockBuilder(Connection::class)
                                       ->disableOriginalConstructor()
                                       ->getMock();

        $this->schemeManager    = $this->getMockBuilder(AbstractSchemaManager::class)
                                       ->disableOriginalConstructor()
                                       ->getMock();

        $this->connection->method('createSchemaManager')
                         ->willReturn($this->schemeManager);

        $this->validator        = new DatabasenameValidator($this->connection);
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testValidateReturnFalseIfNameIsNotFount(): void
    {
        $databasename   = 'example_databasename';
        $databases      = ['test_database', 'my_test_databasename'];

        $this->schemeManager->expects(self::once())
                            ->method('listDatabases')
                            ->willReturn($databases);

        $this->assertFalse($this->validator->validate($databasename));
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testValidateReturnTrueIfNameIsFount(): void
    {
        $databasename   = 'example_databasename';
        $databases      = ['test_database', 'my_test_databasename', 'example_databasename'];

        $this->schemeManager->expects(self::once())
                            ->method('listDatabases')
                            ->willReturn($databases);

        $this->assertTrue($this->validator->validate($databasename));
    }
}
