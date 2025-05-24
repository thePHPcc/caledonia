<?php declare(strict_types=1);
namespace example\framework\event\test\extension;

abstract readonly class Subscriber
{
    private Extension $extension;

    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }

    final protected function extension(): Extension
    {
        return $this->extension;
    }
}
