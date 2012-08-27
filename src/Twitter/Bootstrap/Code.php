<?php

class Twitter_Bootstrap_Code extends Zend_View_Helper_HtmlElement
{
    public function code($code, $isPreScrollable = false, $attributes = null)
    {
        if ($isPreScrollable) {

            if (null === $attributes) {
                $attributes = array();
            }

            if (!array_key_exists('class', $attributes)) {
                $attributes['class'] = array();
            }

            if (is_array($attributes['class'])) {
                $attributes['class'][] = 'pre-scrollable';
            } elseif (false === strpos($attributes['class'], 'pre-scrollable')) {
                $attributes['class'] .= ' pre-scrollable';
            }
        }

        return sprintf('<pre%s>%s</pre>', $this->_htmlAttribs($attributes), $this->view->escape($code));
    }
}