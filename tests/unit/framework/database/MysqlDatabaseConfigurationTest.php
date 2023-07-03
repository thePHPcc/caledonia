<?php declare(strict_types=1);
namespace example\framework\database;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(MysqlDatabaseConfiguration::class)]
#[Group('framework')]
#[Group('framework/database')]
#[Small]
final class MysqlDatabaseConfigurationTest extends TestCase
{
    public function testHasHost(): void
    {
        $this->assertSame('the-host', $this->configuration()->host());
    }

    public function testHasUsername(): void
    {
        $this->assertSame('the-user', $this->configuration()->username());
    }

    public function testHasPassword(): void
    {
        $this->assertSame('the-password', $this->configuration()->password());
    }

    public function testHasDatabase(): void
    {
        $this->assertSame('the-database', $this->configuration()->database());
    }

    private function configuration(): MysqlDatabaseConfiguration
    {
        return new MysqlDatabaseConfiguration(
            'the-host',
            'the-user',
            'the-password',
            'the-database',
        );
    }
}
