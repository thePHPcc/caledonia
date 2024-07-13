<?php declare(strict_types=1);
namespace example\framework\database;

use const MYSQLI_ASSOC;
use function array_values;
use mysqli;
use mysqli_result;
use mysqli_sql_exception;

trait MysqliReadingDatabaseConnectionTrait
{
    /**
     * @param non-empty-string $sql
     *
     * @throws DatabaseException
     *
     * @return list<array<non-empty-string, mixed>>
     */
    public function query(string $sql, string ...$parameters): array
    {
        $this->ensureParameterCountMatches($sql, $parameters);

        try {
            $result = $this->connection()->execute_query($sql, array_values($parameters));

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

    abstract protected function ensureParameterCountMatches(string $sql, array $parameters): void;

    abstract protected function connection(): mysqli;
}
