<?php declare(strict_types=1);
namespace example\caledonia\domain;

use function sprintf;
use example\framework\event\Event;
use example\framework\library\Uuid;

/**
 * @no-named-arguments
 */
final readonly class GoodSoldEvent extends Event
{
    private Good $good;
    private Price $price;

    /**
     * @var positive-int
     */
    private int $amount;

    /**
     * @param positive-int $amount
     */
    public function __construct(Uuid $id, Good $good, Price $price, int $amount)
    {
        parent::__construct($id);

        $this->good   = $good;
        $this->price  = $price;
        $this->amount = $amount;
    }

    /**
     * @return non-empty-string
     */
    public function topic(): string
    {
        return 'market.good-sold';
    }

    /**
     * @return non-empty-string
     */
    public function asString(): string
    {
        return sprintf(
            '%d %s sold at price %d',
            $this->amount,
            $this->good->value,
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
     * @return positive-int
     */
    public function amount(): int
    {
        return $this->amount;
    }
}
