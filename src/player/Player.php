<?php declare(strict_types=1);
namespace example\caledonia;

final class Player
{
    /**
     * @psalm-var non-empty-string
     */
    private readonly string $name;
    private Money $balance;

    /**
     * @psalm-var int<0, max>
     */
    private int $bread;

    /**
     * @psalm-var int<0, max>
     */
    private int $cheese;

    /**
     * @psalm-var int<0, max>
     */
    private int $grain;

    /**
     * @psalm-var int<0, max>
     */
    private int $milk;

    /**
     * @psalm-var int<0, max>
     */
    private int $whisky;

    /**
     * @psalm-var int<0, max>
     */
    private int $wool;

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param int<0, max> $bread
     * @psalm-param int<0, max> $cheese
     * @psalm-param int<0, max> $grain
     * @psalm-param int<0, max> $milk
     * @psalm-param int<0, max> $whisky
     * @psalm-param int<0, max> $wool
     *
     * @throws NameMustNotBeEmptyException
     */
    public static function from(string $name, Money $balance, int $bread, int $cheese, int $grain, int $milk, int $whisky, int $wool): self
    {
        return new self(
            $name,
            $balance,
            $bread,
            $cheese,
            $grain,
            $milk,
            $whisky,
            $wool,
        );
    }

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param int<0, max> $bread
     * @psalm-param int<0, max> $cheese
     * @psalm-param int<0, max> $grain
     * @psalm-param int<0, max> $milk
     * @psalm-param int<0, max> $whisky
     * @psalm-param int<0, max> $wool
     *
     * @throws NameMustNotBeEmptyException
     */
    private function __construct(string $name, Money $balance, int $bread, int $cheese, int $grain, int $milk, int $whisky, int $wool)
    {
        $this->ensureNameIsNotEmpty($name);

        $this->name    = $name;
        $this->balance = $balance;
        $this->bread   = $bread;
        $this->cheese  = $cheese;
        $this->grain   = $grain;
        $this->milk    = $milk;
        $this->whisky  = $whisky;
        $this->wool    = $wool;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function name(): string
    {
        return $this->name;
    }

    public function balance(): Money
    {
        return $this->balance;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function bread(): int
    {
        return $this->bread;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function cheese(): int
    {
        return $this->cheese;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function grain(): int
    {
        return $this->grain;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function milk(): int
    {
        return $this->milk;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function whisky(): int
    {
        return $this->whisky;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function wool(): int
    {
        return $this->wool;
    }

    /**
     * @throws NameMustNotBeEmptyException
     */
    private function ensureNameIsNotEmpty(string $name): void
    {
        if (empty($name)) {
            throw new NameMustNotBeEmptyException;
        }
    }
}
