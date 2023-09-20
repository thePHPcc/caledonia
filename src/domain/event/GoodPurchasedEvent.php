<?php declare(strict_types=1);
namespace example\caledonia\domain;

use function sprintf;
use example\framework\event\Event;
use example\framework\library\Uuid;

final readonly class GoodPurchasedEvent extends Event
{
    private Good $good;
    private Price $price;

    /**
     * @psalm-var positive-int
     */
    private int $amount;

    /**
     * @psalm-param positive-int $amount
     */
    public function __construct(Uuid $id, Good $good, Price $price, int $amount)
    {
        parent::__construct($id);

        $this->good   = $good;
        $this->price  = $price;
        $this->amount = $amount;
    }

    public function topic(): string
    {
        return 'market.good-purchased';
    }

    /**
     * @return non-empty-string
     */
    public function asString(): string
    {
        return sprintf(
            '%d %s purchased at price %d',
            $this->amount,
            $this->good->asString(),
            $this->price->asInt(),
        );
    }

    public function good(): Good
    {
        return $this->good;
    }

    public function price(): Price
    {
        return $this->price;
    }

    /**
     * @psalm-return positive-int
     */
    public function amount(): int
    {
        return $this->amount;
    }
}
