<?php

/**
 * @since       08.09.2024 - 17:45
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Database\Services\Factories;

use Esit\Valueobjects\Classes\Database\Services\Factories\DatabaseFactory;
use Esit\Valueobjects\Classes\Database\Services\Validators\DatabasenameValidator;
use Esit\Valueobjects\Classes\Database\Services\Validators\FieldnameValidator;
use Esit\Valueobjects\Classes\Database\Services\Validators\TablenameValidator;
use Esit\Valueobjects\Classes\Database\Valueobjects\TablenameValue;
use PHPUnit\Framework\TestCase;

class DatabaseFactoryTest extends TestCase
{


    private $databasenameValidator;


    private $fieldnameValidator;



    private $tablenameValidator;


    private $tablenameValue;


    private DatabaseFactory $factory;


    protected function setUp(): void
    {
        $this->databasenameValidator = $this->getMockBuilder(DatabasenameValidator::class)
                                            ->disableOriginalConstructor()
                                            ->getMock();

        $this->fieldnameValidator   = $this->getMockBuilder(FieldnameValidator::class)
                                           ->disableOriginalConstructor()
                                           ->getMock();

        $this->tablenameValidator   = $this->getMockBuilder(TablenameValidator::class)
                                           ->disableOriginalConstructor()
                                           ->getMock();

        $this->tablenameValue       = $this->getMockBuilder(TablenameValue::class)
                                           ->disableOriginalConstructor()
                                           ->getMock();

        $this->factory              = new DatabaseFactory(
            $this->databasenameValidator,
            $this->fieldnameValidator,
            $this->tablenameValidator);
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCreateDatabasenameFromString(): void
    {
        $this->databasenameValidator->expects(self::once())
                                    ->method('validate')
                                    ->willReturn(true);

        $this->assertNotNull($this->factory->createDatabasenameFromString('exampleDatabase'));
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCreateFieldnameFromStringCreateTablenaemValueIfTableNameIsAString(): void
    {
        $tablename = 'tl_example';

        $this->tablenameValidator->expects(self::once())
                                 ->method('validate')
                                 ->willReturn(true);

        $this->fieldnameValidator->expects(self::once())
                                 ->method('validate')
                                 ->willReturn(true);

        $this->assertNotNull($this->factory->createFieldnameFromString('testfield', $tablename));
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCreateFieldnameFromStringuseTablenaemValueIfTableNameIsATablenameValue(): void
    {
        $tablename = 'tl_example';

        $this->tablenameValidator->expects(self::never())
                                 ->method('validate');

        $this->fieldnameValidator->expects(self::once())
                                 ->method('validate')
                                 ->willReturn(true);

        $this->assertNotNull($this->factory->createFieldnameFromString('testfield', $this->tablenameValue));
    }


    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCreateTablenameFromString(): void
    {
        $this->tablenameValidator->expects(self::once())
                                 ->method('validate')
                                 ->willReturn(true);

        $this->assertNotNull($this->factory->createTablenameFromString('tl_example'));
    }
}
