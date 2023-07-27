<?php declare(strict_types=1);
namespace example\framework\database;

use const MYSQLI_ASSOC;
use const MYSQLI_OPT_INT_AND_FLOAT_NATIVE;
use const MYSQLI_REPORT_ERROR;
use const MYSQLI_REPORT_STRICT;
use function array_values;
use function count;
use function mysqli_report;
use function substr_count;
use mysqli;
use mysqli_result;
use mysqli_sql_exception;

final readonly class MysqlDatabase implements Database
{
    private mysqli $mysqli;

    public static function connect(MysqlDatabaseConfiguration $configuration): self
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $connection = new mysqli(
            $configuration->host(),
            $configuration->username(),
            $configuration->password(),
            $configuration->database(),
        );

        $connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

        return new self($connection);
    }

    private function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * @psalm-param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    public function execute(string $sql, string ...$parameters): true
    {
        $this->ensureParameterCountMatches($sql, $parameters);

        try {
            $result = $this->mysqli->execute_query($sql, array_values($parameters));
        } catch (mysqli_sql_exception $e) {
            throw new DatabaseException(
                $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }

        if ($result !== true) {
            throw new DatabaseException('Query unexpectedly returned a result');
        }

        return true;
    }

    /**
     * @psalm-param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    public function query(string $sql, string ...$parameters): array
    {
        $this->ensureParameterCountMatches($sql, $parameters);

        try {
            $result = $this->mysqli->execute_query($sql, array_values($parameters));

            if (!$result instanceof mysqli_result) {
                throw new DatabaseException('Query did not return a result');
            }

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            throw new DatabaseException(
                $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * @psalm-param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    private function ensureParameterCountMatches(string $sql, array $parameters): void
    {
        if (substr_count($sql, '?') !== count($parameters)) {
            throw new DatabaseException('Number of parameters does not match number of placeholders');
        }
    }
}
