<?php

class Twitter_Bootstrap_Typography_Blockquote extends Zend_View_Helper_HtmlElement
{
    public function blockquote($text, $source = null, $cite = null, $citeTitle = null, $attributes = null)
    {
        if (null !== $source) {
            $citeStr = null;
            if (null !== $cite) {
                $citeStr = sprintf('<cite title="%s">%s</cite>', $this->view->escape($citeTitle), $this->view->escape($cite));
            }

            $source = sprintf(' <small>%s</small>', $this->view->escape($source) . ' ' . $citeStr);
        }

        return sprintf('<blockquote%s>%s</blockquote>', (null !== $attributes ? $this->_htmlAttribs($attributes) : ''), $this->view->escape($text) . $source);
    }
}