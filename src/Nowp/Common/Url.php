<?php
/**
 *
 */

namespace Nowp\Common;


class Url 
{
    function __construct($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid URL');
        }

        $this->url = $url;
    }

    function __toString()
    {
        return $this->url;
    }
}