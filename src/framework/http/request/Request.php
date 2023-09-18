<?php declare(strict_types=1);
namespace example\framework\http;

use function assert;
use function file_get_contents;

abstract readonly class Request
{
    private string $uri;

    /**
     * @throws UnsupportedRequestException
     */
    public static function fromSuperGlobals(): GetRequest|PostRequest
    {
        assert(isset($_SERVER['REQUEST_METHOD']));
        assert(isset($_SERVER['REQUEST_URI']));

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return new GetRequest(
                $_SERVER['REQUEST_URI'],
                $_GET,
            );
        }

        // @codeCoverageIgnoreStart
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return new PostRequest(
                $_SERVER['REQUEST_URI'],
                file_get_contents('php://input'),
            );
        }

        throw new UnsupportedRequestException;
        // @codeCoverageIgnoreEnd
    }

    protected function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * @psalm-assert-if-true GetRequest $this
     */
    public function isGetRequest(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true PostRequest $this
     */
    public function isPostRequest(): bool
    {
        return false;
    }
}
