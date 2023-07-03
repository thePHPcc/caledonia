<?php declare(strict_types=1);
namespace example\framework\database;

/**
 * @psalm-immutable
 */
final readonly class MysqlDatabaseConfiguration
{
    private string $host;
    private string $username;
    private string $password;
    private string $database;

    public function __construct(string $host, string $username, string $password, string $database)
    {
        $this->host     = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
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

    public function database(): string
    {
        return $this->database;
    }
}
