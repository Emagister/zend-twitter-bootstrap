<?php

use Mockery as m;

class Twitter_Bootstrap_Tables_Table_CellTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Twitter_Bootstrap_Tables_Table_Cell
     */
    private $object;

    protected function setUp()
    {
        $this->object = new Twitter_Bootstrap_Tables_Table_Cell();
    }

    protected function tearDown()
    {
        $this->object = null;
    }

    public function testCellsAreRendered()
    {
        $expected = <<<EOS
<td class="test">test</td>
EOS;

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with('test')->andReturn('test')->twice();

        $this->object->setValue('test');
        $this->object->setAttributes(array(
            'class' => 'test'
        ));
        $this->object->setView($view);

        $this->assertEquals($expected, $this->object->__toString());
    }

    public function testCellsAreRenderedAsTableHeaders()
    {
        $expected = <<<EOS
<th class="test">test</th>
EOS;

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with('test')->andReturn('test')->twice();

        $this->object->isHeader(true);
        $this->object->setValue('test');
        $this->object->setAttributes(array(
            'class' => 'test'
        ));
        $this->object->setView($view);

        $this->assertEquals($expected, $this->object->__toString());
    }
}