<?php

class Twitter_Bootstrap_Images_PolaroidImage extends Twitter_Bootstrap_Images_AbstractImage
{
    /**
     * Returns the class name that should be used to render the image
     *
     * @return mixed
     */
    protected function getClassName()
    {
        return 'img-polaroid';
    }

    /**
     * Returns a rounded image tag
     *
     * @param string $src
     * @param array $attributes
     *
     * @return string
     */
    public function polaroidImage($src, array $attributes = null)
    {
        return $this->_renderImage($src, $attributes);
    }
}