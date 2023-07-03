<?php declare(strict_types=1);
namespace example\framework\database;

use example\framework\Exception;
use RuntimeException;

final class DatabaseException extends RuntimeException implements Exception
{
}
