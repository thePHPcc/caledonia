<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MarketQuery::class)]
#[UsesClass(Response::class)]
#[Small]
#[TestDox('MarketQuery')]
final class MarketQueryTest extends TestCase
{
    #[TestDox('Returns response with projected HTML')]
    public function testReturnsResponseWithProjectedHtml(): void
    {
        $html = 'html';

        $reader = $this->createStub(MarketHtmlProjectionReader::class);

        $reader
            ->method('read')
            ->willReturn($html);

        $response = new MarketQuery($reader)->execute();

        $this->assertSame($html, $response->body());
    }
}
