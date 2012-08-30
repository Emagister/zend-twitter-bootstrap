<?php

use Mockery as m;

class Twitter_Bootstrap_Tables_TableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Twitter_Bootstrap_Tables_Table
     */
    private $object;

    protected function setUp()
    {
        $this->object = new Twitter_Bootstrap_Tables_Table();
    }

    protected function tearDown()
    {
        $this->object = null;
    }

    public function testCanAddRows()
    {
        $row = m::mock('Twitter_Bootstrap_Tables_Table_Row');

        $view = m::mock('Zend_View');
        $view->shouldReceive('row')->once()->andReturn($row);

        $this->object->setView($view);
        $table = $this->object->table();
        $row = $table->row();
        $table->add($row);

        $this->assertInstanceOf('Twitter_Bootstrap_Tables_Table_Row', $row);
        $this->assertCount(1, $table);
    }

    public function testCanAddStrippedToTables()
    {
        $this->assertFalse($this->object->isStripped());
        $this->object->isStripped(true);
        $this->assertTrue($this->object->isStripped());
    }

    public function testCanAddBorderedToTables()
    {
        $this->assertFalse($this->object->isBordered());
        $this->object->isBordered(true);
        $this->assertTrue($this->object->isBordered());
    }

    public function testCanAddHoverToTable()
    {
        $this->assertFalse($this->object->isHover());
        $this->object->isHover(true);
        $this->assertTrue($this->object->isHover());
    }

    public function testCanAddCondensedToTable()
    {
        $this->assertFalse($this->object->isCondensed());
        $this->object->isCondensed(true);
        $this->assertTrue($this->object->isCondensed());
    }

    public function testRendersTableElement()
    {
        $expected = <<<EOS
<table class="table"></table>
EOS;
        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with('table')->andReturn('table');

        $this->object->setView($view);

        $this->assertEquals($expected, $this->object->__toString());
    }

    public function testRendersTableElementWithAttributes()
    {
        $expected = <<<EOS
<table class="table table-stripped table-bordered table-hover table-condensed"></table>
EOS;

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with('table table-stripped table-bordered table-hover table-condensed')->andReturn('table table-stripped table-bordered table-hover table-condensed');

        $this->object->setView($view);

        $this->object->isStripped(true);
        $this->object->isBordered(true);
        $this->object->isHover(true);
        $this->object->isCondensed(true);

        $this->assertEquals($expected, $this->object->__toString());
    }

    public function testRendersTableWithCaption()
    {
        $expected = <<<EOS
<table class="table"><caption>test</caption></table>
EOS;

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with('table')->andReturn('table');
        $view->shouldReceive('escape')->with('test')->andReturn('test');

        $this->object->setCaption('test');
        $this->object->setView($view);

        $this->assertEquals($expected, $this->object->__toString());
    }

    public function testRendersTableWithTableHeader()
    {
        $expected = <<<EOS
<table class="table"><thead><tr><th>test</th><th>test2</th><th>test3</th></tr></thead></table>
EOS;

        $cell1 = m::mock('Twitter_Bootstrap_Tables_Table_Cell');
        $cell1->shouldReceive('__toString')->andReturn('<th>test</th>');
        $cell1->shouldReceive('isHeader')->with(true)->once();

        $cell2 = m::mock('Twitter_Bootstrap_Tables_Table_Cell');
        $cell2->shouldReceive('__toString')->andReturn('<th>test2</th>');
        $cell2->shouldReceive('isHeader')->with(true)->once();

        $cell3 = m::mock('Twitter_Bootstrap_Tables_Table_Cell');
        $cell3->shouldReceive('__toString')->andReturn('<th>test3</th>');
        $cell3->shouldReceive('isHeader')->with(true)->once();

        $view = m::mock('Zend_View');
        $view->shouldReceive('escape')->with('class')->andReturn('class');
        $view->shouldReceive('escape')->with('table')->andReturn('table');
        $view->shouldReceive('cell')->andReturn($cell1, $cell2, $cell3);

        $row = new Twitter_Bootstrap_Tables_Table_Row();
        $row->setView($view);
        $row
            ->add('test')
            ->add('test2')
            ->add('test3')
        ;

        $this->object->setHeader($row);

        $this->object->setView($view);
        $this->assertEquals($expected, $this->object->__toString());
    }

    public function testRendersTableWithAllFeatures()
    {
        $expected = <<<EOS
<table class="table table-stripped table-bordered table-hover table-condensed"><caption>test</caption><thead><tr><th>TH1</th><th>TH2</th></tr></thead><tbody><tr><td>CELL1</td><td>CELL2</td></tr><tr class="success"><td>CELL1</td><td>CELL2</td></tr><tr class="error"><td>CELL1</td><td>CELL2</td></tr><tr class="info"><td>CELL1</td><td>CELL2</td></tr></tbody></table>
EOS;

        $view = new Zend_View();

        $view->addHelperPath(dirname(dirname(dirname(dirname(__DIR__)))) . '/src/Twitter/Bootstrap/Tables/Table', 'Twitter_Bootstrap_Tables_Table');

        $this->object->setView($view);

        $this->object->isStripped(true);
        $this->object->isBordered(true);
        $this->object->isHover(true);
        $this->object->isCondensed(true);
        $this->object->setCaption('test');

        $header = $this->object->row();
        $header->setView($view);
        $header
            ->add('TH1')
            ->add('TH2')
        ;
        $this->object->setHeader($header);

        $row = $this->object->row();
        $row->setView($view);
        $row
            ->add('CELL1')
            ->add('CELL2')
        ;
        $this->object->add($row);

        $row = $this->object->row();
        $row->setView($view);
        $row
            ->setState(Twitter_Bootstrap_Tables_Table_Row::STATE_SUCCESS)
            ->add('CELL1')
            ->add('CELL2')
        ;
        $this->object->add($row);

        $row = $this->object->row();
        $row->setView($view);
        $row
            ->setState(Twitter_Bootstrap_Tables_Table_Row::STATE_ERROR)
            ->add('CELL1')
            ->add('CELL2')
        ;
        $this->object->add($row);

        $row = $this->object->row();
        $row->setView($view);
        $row
            ->setState(Twitter_Bootstrap_Tables_Table_Row::STATE_INFO)
            ->add('CELL1')
            ->add('CELL2')
        ;
        $this->object->add($row);

        $this->assertEquals($expected, $this->object->__toString());
    }
}