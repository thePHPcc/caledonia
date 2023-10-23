<?php declare(strict_types=1);
namespace example\framework\http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresFunction;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(Response::class)]
#[Group('framework')]
#[Group('framework/http')]
#[Small]
final class ResponseTest extends TestCase
{
    public function testHasInitiallyNoHeaders(): void
    {
        $this->assertSame([], (new Response)->headers());
    }

    public function testHeaderCanBeAdded(): void
    {
        $response = new Response;
        $header = 'the-header';

        $response->addHeader($header);

        $this->assertSame([$header], $response->headers());
    }

    public function testHasInitiallyEmptyBody(): void
    {
        $this->assertSame('', (new Response)->body());
    }

    public function testBodyCanBeSet(): void
    {
        $response = new Response;
        $body = 'the-body';

        $response->setBody($body);

        $this->assertSame($body, $response->body());
    }

    #[RunInSeparateProcess]
    #[RequiresFunction('xdebug_get_headers')]
    public function testCanBeSent(): void
    {
        $response = new Response;
        $header = 'the-header';
        $body = 'the-body';

        $response->addHeader($header);
        $response->setBody($body);

        $this->expectOutputString($body);

        $response->send();

        $this->assertSame([$header], xdebug_get_headers());
    }
}
