<?php declare(strict_types=1);
namespace example\caledonia\domain;

use RuntimeException;

final class AmountMustNotBeNegativeException extends RuntimeException implements Exception
{
}
