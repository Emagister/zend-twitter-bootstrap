<?php

class Twitter_Bootstrap_Typography_Lead extends Zend_View_Helper_HtmlElement
{
    public function lead($text, $attributes = null)
    {
        if (null === $attributes) {
            $attributes = array();
        }

        if (!array_key_exists('class', $attributes)) {
            $attributes['class'] = array('lead');
        }

        if (is_array($attributes['class'])) {
            $attributes['class'][] = 'lead';
        } elseif (false === strpos($attributes['class'], 'lead')) {
            $attributes['class'] .= ' lead';
        }

        $attributes['class'] = array_unique($attributes['class']);

        return sprintf('<p%s>%s</p>', $this->_htmlAttribs($attributes), $this->view->escape($text));
    }
}