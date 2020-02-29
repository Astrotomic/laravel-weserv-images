<?php

use Astrotomic\Weserv\Images\Laravel\Facades\WeservImages;
use Astrotomic\Weserv\Images\Url;

if (! function_exists('weserv')) {
    function weserv(string $imageUrl): Url
    {
        return WeservImages::make($imageUrl);
    }
}
