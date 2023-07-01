<?php declare(strict_types=1);
namespace example\caledonia;

/**
 * @psalm-immutable
 */
final class Money
{
    /**
     * @psalm-var int<0, max>
     */
    private int $amount;

    /**
     * @psalm-param int<0, max> $amount
     *
     * @throws AmountMustNotBeNegativeException
     */
    public static function from(int $amount): self
    {
        return new self($amount);
    }

    /**
     * @psalm-param int<0, max> $amount
     *
     * @throws AmountMustNotBeNegativeException
     */
    private function __construct(int $amount)
    {
        $this->ensureAmountIsNotNegative($amount);

        $this->amount = $amount;
    }

    /**
     * @psalm-return int<0, max>
     */
    public function asInt(): int
    {
        return $this->amount;
    }

    public function plus(self $other): self
    {
        /** @psalm-suppress MissingThrowsDocblock */
        return new self($this->asInt() + $other->asInt());
    }

    /**
     * @throws AmountMustNotBecomeNegativeException
     */
    public function minus(self $other): self
    {
        $amount = $this->asInt() - $other->asInt();

        if ($amount < 0) {
            throw new AmountMustNotBecomeNegativeException;
        }

        /** @psalm-suppress MissingThrowsDocblock */
        return new self($amount);
    }

    public function equals(self $other): bool
    {
        return $this->asInt() === $other->asInt();
    }

    /**
     * @throws AmountMustNotBeNegativeException
     */
    private function ensureAmountIsNotNegative(int $amount): void
    {
        if ($amount < 0) {
            throw new AmountMustNotBeNegativeException;
        }
    }
}
