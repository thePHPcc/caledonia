<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @no-named-arguments
 */
enum Good: string
{
    /**
     * @param 'bread'|'cheese'|'grain'|'milk'|'whisky'|'wool' $good
     */
    public static function fromString(string $good): self
    {
        return match ($good) {
            'bread'  => self::Bread,
            'cheese' => self::Cheese,
            'grain'  => self::Grain,
            'milk'   => self::Milk,
            'whisky' => self::Whisky,
            'wool'   => self::Wool,
        };
    }

    case Bread  = 'bread';
    case Cheese = 'cheese';
    case Grain  = 'grain';
    case Milk   = 'milk';
    case Whisky = 'whisky';
    case Wool   = 'wool';
}
