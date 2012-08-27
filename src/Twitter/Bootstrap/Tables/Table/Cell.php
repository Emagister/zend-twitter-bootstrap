<?php

class Twitter_Bootstrap_Tables_Table_Cell extends Zend_View_Helper_HtmlElement
{
    /**
     * The cell value
     *
     * @var string
     */
    protected $_value;

    /**
     * The cell attributes map
     *
     * @var array
     */
    protected $_attributes;

    /**
     * @var boolean
     */
    protected $_isHeader;

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->_attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return boolean
     */
    public function isHeader()
    {
        $this->_isHeader = true;
    }

    /**
     * Generates a new table cell
     *
     * @param string $value
     * @param array $attributes
     *
     * @return Twitter_Bootstrap_Tables_Table_Cell
     */
    public function cell($value, array $attributes = null)
    {
        $cell = new static();
        $cell->setView($this->view);
        $cell->setValue($value);

        if (null !== $attributes) {
            $cell->setAttributes($attributes);
        }

        return $cell;
    }

    /**
     * Renders the table cell
     *
     * @return string
     */
    public function __toString()
    {
        $tag = 't' . ($this->_isHeader ? 'h' : 'd');
        return sprintf('<%s%s>%s</%s>', $tag, $this->_htmlAttribs($this->getAttributes()), $this->view->escape($this->getValue()), $tag);
    }
}
