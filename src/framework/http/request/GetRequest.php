<?php declare(strict_types=1);
namespace example\framework\http;

final readonly class GetRequest extends Request
{
    private array $parameters;

    public static function from(string $uri, array $parameters): self
    {
        return new self($uri, $parameters);
    }

    protected function __construct(string $uri, array $parameters)
    {
        parent::__construct($uri);

        $this->parameters = $parameters;
    }

    public function has(string $parameter): bool
    {
        return isset($this->parameters[$parameter]);
    }

    /**
     * @throws ParameterDoesNotExistException
     */
    public function get(string $parameter): string
    {
        if (!$this->has($parameter)) {
            throw new ParameterDoesNotExistException;
        }

        return (string) $this->parameters[$parameter];
    }

    public function isGetRequest(): true
    {
        return true;
    }
}
