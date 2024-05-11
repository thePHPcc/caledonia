<?php declare(strict_types=1);
namespace example\caledonia\domain;

final readonly class SellGoodCommand
{
    private Good $good;

    /**
     * @var positive-int
     */
    private int $amount;

    /**
     * @param positive-int $amount
     */
    public function __construct(Good $good, int $amount)
    {
        $this->good   = $good;
        $this->amount = $amount;
    }

    public function good(): Good
    {
        return $this->good;
    }

    /**
     * @return positive-int
     */
    public function amount(): int
    {
        return $this->amount;
    }
}
