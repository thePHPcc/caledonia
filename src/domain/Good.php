<?php declare(strict_types=1);
namespace example\caledonia\domain;

/**
 * @no-named-arguments
 */
enum Good: string
{
    case Bread  = 'bread';
    case Cheese = 'cheese';
    case Grain  = 'grain';
    case Milk   = 'milk';
    case Whisky = 'whisky';
    case Wool   = 'wool';
}
