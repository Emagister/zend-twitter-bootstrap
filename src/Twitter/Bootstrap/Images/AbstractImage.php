<?php

abstract class Twitter_Bootstrap_Images_AbstractImage extends Zend_View_Helper_HtmlElement
{
    /**
     * Returns the class name that should be used to render the image
     *
     * @return mixed
     */
    abstract protected function getClassName();

    /**
     * Renders the image tag
     *
     * @param string $src
     * @param array $attributes
     *
     * @return string
     */
    protected function _renderImage($src, array $attributes = null)
    {
        if (null === $attributes) {
            $attributes = array();
        }

        if (!array_key_exists('class', $attributes)) {
            $attributes['class'] = array();
        }

        $className = $this->getClassName();
        if (is_array($attributes['class'])) {
            $attributes['class'][] = $className;
        } else {
            $attributes['class'] .= ' ' . $className;
        }

        return sprintf('<img src="%s"%s />', $this->view->escape($src), $this->_htmlAttribs($attributes));
    }
}