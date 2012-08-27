<?php

class Twitter_Bootstrap_Tables_Table_Row
    extends Zend_View_Helper_HtmlElement
    implements IteratorAggregate, Countable, ArrayAccess
{
    const STATE_SUCCESS = 'success';
    const STATE_ERROR   = 'error';
    const STATE_INFO    = 'info';

    /**
     * @var array
     */
    protected $_cells = array();

    /**
     * @var string
     */
    protected $_state;

    /**
     * @var array
     */
    protected $_attributes;

    /**
     * Generates a new table row
     *
     * @param array $attributes
     *
     * @return Twitter_Bootstrap_Tables_Table_Row
     */
    public function row(array $attributes = null)
    {
        $row = new static();

        if (null !== $attributes) {
            $row->setAttributes($attributes);
        }

        return $row;
    }

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
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new ArrayIterator($this->_cells);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return sizeof($this->_cells);
    }

    /**
     * Adds a cell to the row
     *
     * @param string|Twitter_Bootstrap_Tables_Table_Cell $cell
     * @param array $attributes
     */
    public function add($value, array $attributes = null)
    {
        $cell = $value;
        if (is_string($value)) {
            $cell = $this->view->cell($value, $attributes);
        }

        $this->_cells[] = $cell;

        return $this;
    }

    /**
     * Set whether this row should be a table header or not
     *
     * @param bool $isHeader
     *
     * @return Twitter_Bootstrap_Tables_Table_Row
     */
    public function isHeader($isHeader = true)
    {
        foreach ($this->_cells as $cell) {
            $cell->isHeader($isHeader);
        }

        return $this;
    }

    /**
     * Sets the row state
     *
     * @param string $state
     *
     * @return Twitter_Bootstrap_Tables_Table_Row
     */
    public function setState($state = null)
    {
        if (null === $state) {
            $this->_state = $state;
            return $this;
        }

        if (in_array($state, array(static::STATE_SUCCESS, static::STATE_ERROR, static::STATE_INFO))) {
            $this->_state = $state;
        }

        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->_cells);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->_cells[$offset];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->_cells[$offset] = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->_cells[$offset]);
    }

    /**
     * Generates a string representation of the table row
     *
     * @return string
     */
    public function __toString()
    {
        $content = '';

        foreach ($this as $cell) {
            $content .= $cell;
        }

        $attributes = $this->getAttributes() ?: array();

        if (null !== $this->_state) {

            if (!isset($attributes['class'])) {
                $attributes['class'] = array();
            }

            $attributes['class'][] = $this->_state;
        }

        return sprintf('<tr%s>%s</tr>', $this->_htmlAttribs($attributes), $content);
    }
}