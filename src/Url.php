<?php

namespace Astrotomic\Weserv\Images\Laravel;

use Astrotomic\Weserv\Images\Enums\Output;
use Astrotomic\Weserv\Images\Url as BaseUrl;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\HtmlString;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

class Url extends BaseUrl implements Htmlable, Renderable, Responsable, Jsonable, JsonSerializable, Arrayable
{
    public function render(): string
    {
        return $this->toHtml();
    }

    public function toHtml(): string
    {
        return $this->toImg();
    }

    public function toPicture(array $attr = [], array $srcSet = []): HtmlString
    {
        $attr['src'] = $this->toUrl();
        if (! empty($srcSet)) {
            $attr['srcset'] = $this->getSrcSet($srcSet);
        }
        $attributes = $this->getAttributes($attr);

        $webpAttr['type'] = 'image/webp';
        if (! empty($srcSet)) {
            $webpAttr['srcset'] = $webpAttr['src']->getSrcSet($srcSet);
        }
        $webpAttributes = $this->getAttributes($webpAttr);

        return new HtmlString(
            <<<HTML
            <picture>
                <source {$webpAttributes} />
                <img {$attributes} />
            </picture>
            HTML
        );
    }

    public function toResponse($request): Response
    {
        if ($request->expectsJson()) {
            return new JsonResponse($this->toArray());
        }

        return new RedirectResponse($this->toUrl(), 302);
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        $url = clone $this;

        return json_decode(
            file_get_contents(
                $url->output(Output::JSON)->toUrl()
            ),
            true
        );
    }
}
