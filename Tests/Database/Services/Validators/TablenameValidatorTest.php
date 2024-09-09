<?php

/**
 * @since       08.09.2024 - 16:57
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Database\Services\Validators;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Esit\Valueobjects\Classes\Database\Services\Validators\TablenameValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TablenameValidatorTest extends TestCase
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
     * @var TablenameValidator
     */
    private TablenameValidator $validator;


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

        $this->validator        = new TablenameValidator($this->connection);
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testValidateReturnFalseIfNameIsNotFount(): void
    {
        $tablename   = 'tl_example';
        $tables      = ['tl_test', 'tl_my_test'];

        $this->schemeManager->expects(self::once())
                            ->method('listTableNames')
                            ->willReturn($tables);

        $this->assertFalse($this->validator->validate($tablename));
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testValidateReturnTrueIfNameIsFount(): void
    {
        $tablename   = 'tl_example';
        $tables      = ['tl_test', 'tl_my_test', 'tl_example'];

        $this->schemeManager->expects(self::once())
                            ->method('listTableNames')
                            ->willReturn($tables);

        $this->assertTrue($this->validator->validate($tablename));
    }
}
