<?php


class Twitter_Bootstrap_Tables_Table
    extends Zend_View_Helper_HtmlElement
    implements Iterator, Countable
{
    /**
     * @var array
     */
    protected $_rows = array();

    /**
     * Whether the table should be stripped or not
     *
     * @var bool
     */
    protected $_stripped = false;

    /**
     * Whether the table should be bordered or not
     *
     * @var bool
     */
    protected $_bordered = false;

    /**
     * Whether the table should be hovered or not
     *
     * @var bool
     */
    protected $_hover = false;

    /**
     * Whether the table should be condensed or not
     *
     * @var bool
     */
    protected $_condensed = false;

    /**
     * Attributes map
     *
     * @var array
     */
    protected $_attributes = array();

    /**
     * The table caption
     *
     * @var string
     */
    protected $_caption;

    /**
     * @var Twitter_Bootstrap_Tables_Table_Row
     */
    protected $_header;

    /**
     * Direct acces to this helper
     *
     * @return Twitter_Bootstrap_Tables_Table
     */
    public function table(array $attributes = null)
    {
        if (null !== $attributes) {
            $this->_attributes = $attributes;
        }

        return $this;
    }

    /**
     * Get or set the stripped attribute for the table
     *
     * @param bool $isStripped
     *
     * @return bool
     */
    public function isStripped($isStripped = null)
    {
        if (null === $isStripped) {
            return $this->_stripped;
        }

        $this->_stripped = (bool) $isStripped;

        return $this;
    }

    /**
     * Get or set the bordered attribute for the table
     *
     * @param bool $isBordered
     *
     * @return bool
     */
    public function isBordered($isBordered = null)
    {
        if (null === $isBordered) {
            return $this->_bordered;
        }

        $this->_bordered = (bool) $isBordered;

        return $this;
    }

    /**
     * Get or set the hover attribute for the table
     *
     * @param bool $isHover
     *
     * @return bool
     */
    public function isHover($isHover = null)
    {
        if (null === $isHover) {
            return $this->_hover;
        }

        $this->_hover = (bool) $isHover;

        return $this;
    }

    public function isCondensed($isCondensed = null)
    {
        if (null === $isCondensed) {
            return $this->_condensed;
        }

        $this->_condensed = $isCondensed;

        return $this;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption)
    {
        $this->_caption = $caption;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->_caption;
    }

    /**
     * Creates a new row instance
     *
     * @return Twitter_Bootstrap_Tables_Table_Row
     */
    public function row()
    {
        return $this->view->row();
    }

    /**
     * Adds a new row to the rows list
     *
     * @param Twitter_Bootstrap_Tables_Table_Row $row
     */
    public function add(Twitter_Bootstrap_Tables_Table_Row $row)
    {
        $this->_rows[] = $row;
    }

    /**
     * Adds a table header
     *
     * @param string $header
     */
    public function setHeader(Twitter_Bootstrap_Tables_Table_Row $tableHeader)
    {
        $tableHeader->isHeader(true);

        $this->_header = $tableHeader;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return current($this->_rows);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        next($this->_rows);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        key($this->_rows);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $key = $this->key();
        return isset($this->_rows[$key]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        reset($this->_rows);
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
        return sizeof($this->_rows);
    }

    /**
     * Renders the table element
     *
     * @return string
     */
    public function __toString()
    {
        $attributes = $this->_attributes;

        if (!isset($attributes['class'])) {
            $attributes['class'] = array();
        }

        if (!in_array('table', $attributes['class'])) {
            $attributes['class'][] = 'table';
        }

        foreach (array('stripped', 'bordered', 'hover', 'condensed') as $attribute) {
            $method = 'is' . ucfirst($attribute);
            $className = 'table-' . $attribute;

            if ($this->{$method}() && !in_array($className, $attributes['class'])) {
                $attributes['class'][] = $className;
            }
        }

        $content = '';

        if (null !== $this->_caption) {
            $content .= sprintf('<caption>%s</caption>', $this->view->escape($this->_caption));
        }

        if (null !== $this->_header) {
            $content .= sprintf('<thead>%s</thead>', $this->_header);
        }

        $rowsAsString = '';

        if (sizeof($this->_rows)) {
            foreach ($this->_rows as $row) {
                $rowsAsString .= $row;
            }

            $content .= sprintf('<tbody>%s</tbody>', $rowsAsString);
        }

        return sprintf('<table%s>%s</table>', $this->_htmlAttribs($attributes), $content);
    }
}
