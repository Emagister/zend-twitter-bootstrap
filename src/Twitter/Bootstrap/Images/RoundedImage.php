<?php

class Twitter_Bootstrap_Images_RoundedImage extends Twitter_Bootstrap_Images_AbstractImage
{
    /**
     * Returns the class name that should be used to render the image
     *
     * @return mixed
     */
    protected function getClassName()
    {
        return 'img-rounded';
    }

    /**
     * Returns a rounded image tag
     *
     * @param string $src
     * @param array $attributes
     *
     * @return string
     */
    public function roundedImage($src, array $attributes = null)
    {
        return $this->_renderImage($src, $attributes);
    }
}