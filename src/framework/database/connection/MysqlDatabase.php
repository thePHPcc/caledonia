<?php declare(strict_types=1);
namespace example\framework\database;

use const MYSQLI_ASSOC;
use const MYSQLI_OPT_INT_AND_FLOAT_NATIVE;
use const MYSQLI_REPORT_ERROR;
use const MYSQLI_REPORT_STRICT;
use function assert;
use function mysqli_report;
use mysqli;
use mysqli_result;
use mysqli_sql_exception;

final class MysqlDatabase implements Database
{
    private mysqli $mysqli;

    public static function connect(MysqlDatabaseConfiguration $configuration): self
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $connection = new mysqli(
            $configuration->host(),
            $configuration->username(),
            $configuration->password(),
            $configuration->schema(),
        );

        $connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

        return new self($connection);
    }

    private function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * @param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    public function query(string $sql): array|true
    {
        try {
            $result = $this->mysqli->query($sql);

            if ($result === true) {
                return true;
            }

            assert($result instanceof mysqli_result);

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            throw new DatabaseException(
                $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
