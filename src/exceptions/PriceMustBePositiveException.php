<?php declare(strict_types=1);
namespace example\caledonia;

use InvalidArgumentException;

final class PriceMustBePositiveException extends InvalidArgumentException implements Exception
{
}
