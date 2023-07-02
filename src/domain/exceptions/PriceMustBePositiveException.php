<?php declare(strict_types=1);
namespace example\caledonia\domain;

use example\caledonia\Exception;
use InvalidArgumentException;

final class PriceMustBePositiveException extends InvalidArgumentException implements Exception
{
}
