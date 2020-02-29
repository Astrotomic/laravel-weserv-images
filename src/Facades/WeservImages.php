<?php

namespace Astrotomic\Weserv\Images\Laravel\Facades;

use Astrotomic\Weserv\Images\Laravel\Factory;
use Astrotomic\Weserv\Images\Laravel\Url;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Url make(string $imageUrl)
 *
 * @see Factory
 */
class WeservImages extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Factory::class;
    }
}
