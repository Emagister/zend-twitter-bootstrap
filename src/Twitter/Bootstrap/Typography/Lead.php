<?php

class Twitter_Bootstrap_Typography_Lead extends Zend_View_Helper_Abstract
{
    public function lead($text)
    {
        return sprintf('<p class="lead">%s</p>', $text);
    }
}