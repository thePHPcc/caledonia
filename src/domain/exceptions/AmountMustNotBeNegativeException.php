<?php declare(strict_types=1);
namespace example\caledonia\domain;

use example\caledonia\Exception;
use RuntimeException;

final class AmountMustNotBeNegativeException extends RuntimeException implements Exception
{
}
