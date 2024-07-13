<?php declare(strict_types=1);
namespace example\framework\database;

use function count;
use function mysqli_report;
use function substr_count;
use mysqli;

abstract readonly class AbstractMysqliDatabaseConnection
{
    private mysqli $connection;

    /**
     * @param non-empty-string $host
     * @param non-empty-string $username
     * @param non-empty-string $password
     * @param non-empty-string $database
     */
    final public static function connect(string $host, string $username, string $password, string $database): static
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $connection = new mysqli($host, $username, $password, $database);

        $connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

        return new static($connection);
    }

    final private function __construct(mysqli $mysqli)
    {
        $this->connection = $mysqli;
    }

    /**
     * @param non-empty-string $sql
     * @param array<string>    $parameters
     *
     * @throws DatabaseException
     */
    final protected function ensureParameterCountMatches(string $sql, array $parameters): void
    {
        if (substr_count($sql, '?') !== count($parameters)) {
            throw new DatabaseException('Number of parameters does not match number of placeholders');
        }
    }

    final protected function connection(): mysqli
    {
        return $this->connection;
    }
}
