<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Good;
use example\caledonia\domain\GoodPurchasedEvent;
use example\caledonia\domain\GoodSoldEvent;
use example\caledonia\domain\Player;
use example\caledonia\domain\Price;
use example\caledonia\domain\PriceChangedEvent;
use example\framework\event\EventDispatcher;
use example\framework\library\UuidGenerator;

final readonly class DispatchingEventEmitter implements EventEmitter
{
    private EventDispatcher $dispatcher;
    private UuidGenerator $uuidGenerator;

    public function __construct(EventDispatcher $dispatcher, UuidGenerator $uuidGenerator)
    {
        $this->dispatcher    = $dispatcher;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @psalm-param positive-int $amount
     */
    public function goodPurchased(Player $buyer, Good $good, Price $price, int $amount): void
    {
        $this->dispatcher->dispatch(
            new GoodPurchasedEvent(
                $this->uuidGenerator->generate(),
                $buyer,
                $good,
                $price,
                $amount,
            ),
        );
    }

    /**
     * @psalm-param positive-int $amount
     */
    public function goodSold(Player $seller, Good $good, Price $price, int $amount): void
    {
        $this->dispatcher->dispatch(
            new GoodSoldEvent(
                $this->uuidGenerator->generate(),
                $seller,
                $good,
                $price,
                $amount,
            ),
        );
    }

    public function priceChanged(Good $good, Price $old, Price $new): void
    {
        $this->dispatcher->dispatch(
            new PriceChangedEvent(
                $this->uuidGenerator->generate(),
                $good,
                $old,
                $new,
            ),
        );
    }
}
