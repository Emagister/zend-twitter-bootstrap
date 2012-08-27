<?php

use Mockery as m;

class Twitter_Bootstrap_Tables_Table_RowTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Twitter_Bootstrap_Tables_Table_Row
     */
    private $object;

    protected function setUp()
    {
        $this->object = new Twitter_Bootstrap_Tables_Table_Row();
    }

    protected function tearDown()
    {
        $this->object = null;
    }

    public function testCanAddCells()
    {
        $cell = m::mock('Twitter_Bootstrap_Tables_Table_Cell');

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('test')->andReturn('test');
        $view->shouldReceive('cell')->with('test', null)->andReturn($cell);

        $this->object->setView($view);
        $this->object->add('test');

        $this->assertCount(1, $this->object);

        $this->assertEquals($cell, $this->object[0]);
    }

    public function canRenderWithStatesDataProvider()
    {
        return array(
            array(Twitter_Bootstrap_Tables_Table_Row::STATE_SUCCESS),
            array(Twitter_Bootstrap_Tables_Table_Row::STATE_ERROR),
            array(Twitter_Bootstrap_Tables_Table_Row::STATE_INFO)
        );
    }

    /**
     * @dataProvider canRenderWithStatesDataProvider
     */
    public function testCanRenderWithStates($state)
    {
        $cell = m::mock('Twitter_Bootstrap_Tables_Table_Cell');
        $cell->shouldReceive('__toString')->andReturn('<td>test</td>')->once();

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with($state)->andReturn($state);
        $view->shouldReceive('cell')->with('test', null)->andReturn($cell);

        $this->object->setState($state);
        $this->object->setView($view);
        $this->object->add('test');

        $this->assertEquals(sprintf('<tr class="%s"><td>test</td></tr>', $state), $this->object->__toString());
    }
}