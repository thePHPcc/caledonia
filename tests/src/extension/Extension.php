<?php declare(strict_types=1);
namespace example\framework\event\test\extension;

use const PHP_EOL;
use function assert;
use function dirname;
use function file_put_contents;
use function is_dir;
use function is_file;
use function ksort;
use function mkdir;
use function unlink;
use PHPUnit\Event\Test\AdditionalInformationProvided;
use PHPUnit\Runner\Extension\Extension as ExtensionInterface;
use PHPUnit\Runner\Extension\Facade as ExtensionFacade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

final class Extension implements ExtensionInterface
{
    /**
     * @var non-empty-string
     */
    private string $target;

    /**
     * @var array<string, list<array{testdox: string, specification: string}>>
     */
    private array $specification = [];

    public function bootstrap(Configuration $configuration, ExtensionFacade $facade, ParameterCollection $parameters): void
    {
        $target = '/tmp/events.md';

        if ($parameters->has('target')) {
            $target = $parameters->get('target');
        }

        assert($target !== '');

        $this->target = $target;

        $this->prepareLogfile($this->target);

        $facade->registerSubscribers(
            new AdditionalInformationProvidedSubscriber($this),
            new TestRunnerExecutionFinishedSubscriber($this),
        );
    }

    public function testProvidedAdditionalInformation(AdditionalInformationProvided $event): void
    {
        if (!isset($this->specification[$event->test()->testDox()->prettifiedClassName()])) {
            $this->specification[$event->test()->testDox()->prettifiedClassName()] = [];
        }

        $this->specification[$event->test()->testDox()->prettifiedClassName()][] = [
            'testdox'       => $event->test()->testDox()->prettifiedMethodName(),
            'specification' => $event->additionalInformation(),
        ];
    }

    public function flush(): void
    {
        ksort($this->specification);

        $buffer = '';

        foreach ($this->specification as $class => $methods) {
            $buffer .= '# ' . $class . PHP_EOL . PHP_EOL;

            foreach ($methods as $method) {
                $buffer .= '## ' . $method['testdox'] . PHP_EOL . PHP_EOL;
                $buffer .= $method['specification'] . PHP_EOL . PHP_EOL;
            }
        }

        file_put_contents($this->target, $buffer);
    }

    private function prepareLogfile(string $target): void
    {
        if (is_file($target)) {
            unlink($target);

            return;
        }

        if (!is_dir(dirname($target))) {
            @mkdir(dirname($target), 0o777, true);
        }
    }
}
