<?php

namespace Astrotomic\Weserv\Images\Laravel;

use Astrotomic\Weserv\Images\Url;
use Illuminate\Config\Repository as ConfigRepository;

class Factory
{
    protected ConfigRepository $config;

    public function __construct(ConfigRepository $config)
    {
        $this->config = $config;
    }

    public function make(string $imageUrl): Url
    {
        $url = new Url(
            $imageUrl,
            $this->config->get('weserv-images.base_url')
        );

        foreach ($this->config->get('weserv-images.default_options') as $option => $values) {
            call_user_func_array([$url, $option], $values);
        }

        return $url;
    }
}
