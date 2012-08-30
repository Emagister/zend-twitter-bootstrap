<?php

class Twitter_Bootstrap_Images_CircledImage extends Twitter_Bootstrap_Images_AbstractImage
{
    /**
     * Returns the class name that should be used to render the image
     *
     * @return mixed
     */
    protected function getClassName()
    {
        return 'img-circle';
    }

    public function circledImage($src, array $attributes = null)
    {
        return $this->_renderImage($src, $attributes);
    }
}