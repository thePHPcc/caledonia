<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\Factory as FrameworkFactory;

final readonly class Factory
{
    private FrameworkFactory $frameworkFactory;

    public function __construct(FrameworkFactory $frameworkFactory)
    {
        $this->frameworkFactory = $frameworkFactory;
    }
}
