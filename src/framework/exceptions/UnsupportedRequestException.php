<?php declare(strict_types=1);
namespace example\framework\http;

use example\framework\Exception;
use RuntimeException;

final class UnsupportedRequestException extends RuntimeException implements Exception
{
}
