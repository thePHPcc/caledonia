<?php declare(strict_types=1);
namespace example\framework\database;

use function array_values;
use mysqli;
use mysqli_sql_exception;

trait MysqliWritingDatabaseConnectionTrait
{
    /**
     * @param non-empty-string $sql
     *
     * @throws DatabaseException
     */
    public function execute(string $sql, string ...$parameters): true
    {
        $this->ensureParameterCountMatches($sql, $parameters);

        try {
            $result = $this->connection()->execute_query($sql, array_values($parameters));
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

    abstract protected function ensureParameterCountMatches(string $sql, array $parameters): void;

    abstract protected function connection(): mysqli;
}
