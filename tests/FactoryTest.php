<?php

namespace Astrotomic\LaravelWeservImages\Tests;

use Astrotomic\Weserv\Images\Laravel\Facades\WeservImages;
use Astrotomic\Weserv\Images\Laravel\Factory;
use Astrotomic\Weserv\Images\Laravel\Url;
use Astrotomic\Weserv\Images\Laravel\WeservImagesServiceProvider;
use Orchestra\Testbench\TestCase;

final class FactoryTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            WeservImagesServiceProvider::class,
        ];
    }

    /** @test */
    public function it_can_make_url(): void
    {
        $url = $this->app->make(Factory::class)->make('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame('https://images.weserv.nl?url=https%3A%2F%2Fexample.com%2Fimage.jpg', (string) $url);
    }

    /** @test */
    public function it_can_make_url_via_helper(): void
    {
        $url = weserv('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame('https://images.weserv.nl?url=https%3A%2F%2Fexample.com%2Fimage.jpg', (string) $url);
    }

    /** @test */
    public function it_can_make_url_via_facade(): void
    {
        $url = WeservImages::make('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame('https://images.weserv.nl?url=https%3A%2F%2Fexample.com%2Fimage.jpg', (string) $url);
    }

    /** @test */
    public function it_can_make_url_with_different_base_url(): void
    {
        $this->app->make('config')->set('weserv-images.base_url', 'https://images.astrotomic.info');
        $url = $this->app->make(Factory::class)->make('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame('https://images.astrotomic.info?url=https%3A%2F%2Fexample.com%2Fimage.jpg', (string) $url);
    }

    /** @test */
    public function it_can_make_url_with_default_options(): void
    {
        $this->app->make('config')->set('weserv-images.default_options', ['we' => [], 'dpr' => [2]]);
        $url = $this->app->make(Factory::class)->make('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame('https://images.weserv.nl?we=1&dpr=2&url=https%3A%2F%2Fexample.com%2Fimage.jpg', (string) $url);
    }

    /** @test */
    public function it_can_transform_to_picture_tag(): void
    {
        /** @var Url $url */
        $url = $this->app->make(Factory::class)->make('https://example.com/image.jpg');

        static::assertInstanceOf(Url::class, $url);
        static::assertSame(
            <<<HTML
            <picture>
                <source srcset="https://images.weserv.nl?output=webp&dpr=1&url=https%3A%2F%2Fexample.com%2Fimage.jpg 1x, https://images.weserv.nl?output=webp&dpr=2&url=https%3A%2F%2Fexample.com%2Fimage.jpg 2x" type="image/webp" />
                <img src="https://images.weserv.nl?url=https%3A%2F%2Fexample.com%2Fimage.jpg" srcset="https://images.weserv.nl?dpr=1&url=https%3A%2F%2Fexample.com%2Fimage.jpg 1x, https://images.weserv.nl?dpr=2&url=https%3A%2F%2Fexample.com%2Fimage.jpg 2x" alt="My cool avatar" class="avatar" />
            </picture>
            HTML,
            (string) $url->toPicture([
                '1x' => fn(Url $url) => $url->dpr(1),
                '2x' => fn(Url $url) => $url->dpr(2),
            ], 'My cool avatar', 'avatar')
        );
    }
}
