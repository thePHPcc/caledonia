<?php declare(strict_types=1);
namespace example\framework\database;

/**
 * @psalm-immutable
 */
final class MysqlDatabaseConfiguration
{
    private string $host;
    private string $username;
    private string $password;
    private string $schema;

    public function __construct(string $host, string $username, string $password, string $schema)
    {
        $this->host     = $host;
        $this->username = $username;
        $this->password = $password;
        $this->schema   = $schema;
    }

    public function host(): string
    {
        return $this->host;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function schema(): string
    {
        return $this->schema;
    }
}
