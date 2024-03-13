<?php

/**
 * @since       11.03.2024 - 13:15
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects;

use Contao\TestCase\ContaoTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class EsitTestCase
 */
class EsitTestCase extends ContaoTestCase
{


    /**
     * @param $name
     */
    public function __construct($name = '')
    {
        parent::__construct($name);
    }


    /**
     * setup the environment
     */
    protected function setUp(): void
    {
    }


    /**
     * tear down the environment
     */
    protected function tearDown(): void
    {
    }


    /**
     * Ersatz für withConsecutive(), das in PHPUnit 9 deprecated ist!
     * Es wird bei jedem Aufruf immer der Wert aus $returnValues zurückgegeben.
     * @param MockObject $object
     * @param string $method
     * @param mixed $returnValue
     * @param array $expected
     * @return void
     * @example
     *  $expected = [['call-1_value-1', 'call-1_value-2'], ['call-2_value-1', 'call-2_value-2']]
     *  $this->addConsecutive($this->myMock, 'MethodName', $this->myMock, $expected);
     */
    protected function addConsecutive(MockObject $object, string $method, mixed $returnValue, array $expected): void
    {
        $matcher = $this->exactly(\count($expected));

        $object->expects($matcher)
               ->method($method)
               ->with(
                   $this->callback(
                       function(... $param) use ($matcher, $expected) {
                           $count = $matcher->numberOfInvocations() - 1;

                           foreach ($param as $i => $v) {

                               $this->assertSame($expected[$count][$i], $v);
                           }

                           return true;
                       }
                   )
               )
               ->willReturn($returnValue);
    }


    /**
     * Ersatz für withConsecutive(), das in PHPUnit 9 deprecated ist!
     * Es wird nichts zurückgegeben.
     * @param MockObject $object
     * @param string $method
     * @param array $expected
     * @return void
     * @example
     *  $expected = [['call-1_value-1', 'call-1_value-2'], ['call-2_value-1', 'call-2_value-2']]
     *  $this->addConsecutive($this->myMock, 'MethodName', $expected);
     */
    protected function addConsecutiveVoid(MockObject $object, string $method,array $expected): void
    {
        $matcher = $this->exactly(\count($expected));

        $object->expects($matcher)
               ->method($method)
               ->with(
                   $this->callback(
                       function(... $param) use ($matcher, $expected) {
                           $count = $matcher->numberOfInvocations() - 1;

                           foreach ($param as $i => $v) {

                               $this->assertSame($expected[$count][$i], $v);
                           }

                           return true;
                       }
                   )
               );
    }


    /**
     * Ersatz für withConsecutive(), das in PHPUnit 9 deprecated ist!
     * Es wird bei jedem Aufruf ein Wert aus $returnValues zurückgegeben.
     * @param MockObject $object
     * @param string $method
     * @param mixed $returnValue
     * @param array $expected
     * @return void
     * @example
     *  $expected = [['call-1_value-1', 'call-1_value-2'], ['call-2_value-1', 'call-2_value-2']]
     *  $return   = ['retrun1', 'return2'];
     *  $this->addConsecutive($this->myMock, 'MethodName', $return, $expected);
     */
    protected function addConsecutiveReturn(
        MockObject $object,
        string $method,
        mixed $returnValues,
        array $expected
    ): void {
        $matcher = $this->exactly(\count($expected));

        $object->expects($matcher)
               ->method($method)
               ->with(
                   $this->callback(
                       function(... $param) use ($matcher, $expected) {
                           $count = $matcher->numberOfInvocations() - 1;

                           foreach ($param as $i => $v) {

                               $this->assertSame($expected[$count][$i], $v);
                           }

                           return true;
                       }
                   )
               )
               ->willReturnOnConsecutiveCalls(...$returnValues);
    }
}

