# Laravel images.weserv.nl

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/laravel-weserv-images.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/laravel-weserv-images)
[![MIT License](https://img.shields.io/github/license/Astrotomic/laravel-weserv-images.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/laravel-weserv-images/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://offset.earth/treeware)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/laravel-weserv-images/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/laravel-weserv-images/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/243980144/shield)](https://styleci.io/repos/243980144)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/laravel-weserv-images.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/laravel-weserv-images)

This package provides a Laravel wrapper for the fluent URL builder [astrotomic/php-weserv-images](https://github.com/Astrotomic/php-weserv-images).

## Installation

You can install the package via composer:

```bash
composer require astrotomic/laravel-weserv-images
```

```bash
php artisan vendor:publish --provider="Astrotomic\Weserv\Images\Laravel\WeservImagesServiceProvider" --tag=config
```

## Usage

```php
use Astrotomic\Weserv\Images\Enums\Fit;

echo weserv('https://example.com/image.jpg')->w(512)->h(512)->we()->fit(Fit::INSIDE);                      
// https://images.weserv.nl/?w=512&h=512&we=1&fit=inside&url=https%3A%2F%2Fimages.weserv.nl%2Flichtenstein.jpg
```

![](https://images.weserv.nl/?w=512&h=512&we=1&fit=inside&url=https%3A%2F%2Fimages.weserv.nl%2Flichtenstein.jpg)

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dev@astrotomic.info instead of using the issue tracker.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at https://offset.earth/treeware

Read more about Treeware at https://treeware.earth

[![We offset our carbon footprint via Offset Earth](https://toolkit.offset.earth/carbonpositiveworkforce/badge/5e186e68516eb60018c5172b?black=true&landscape=true)](https://offset.earth/treeware)
