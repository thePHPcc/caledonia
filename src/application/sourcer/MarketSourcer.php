<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\caledonia\domain\Market;

interface MarketSourcer
{
    public function source(): Market;
}
