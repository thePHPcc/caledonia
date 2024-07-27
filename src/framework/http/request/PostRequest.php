<?php declare(strict_types=1);
namespace example\framework\http;

/**
 * @no-named-arguments
 */
final readonly class PostRequest extends Request
{
    private string $body;

    public static function from(string $uri, string $body): self
    {
        return new self($uri, $body);
    }

    protected function __construct(string $uri, string $body)
    {
        parent::__construct($uri);

        $this->body = $body;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function isPostRequest(): true
    {
        return true;
    }
}
