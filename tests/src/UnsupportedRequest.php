<?php declare(strict_types=1);
namespace example\framework\http;

final readonly class UnsupportedRequest extends Request
{
    public static function create(): self
    {
        return new self('/');
    }
}
