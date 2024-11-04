<?php declare(strict_types=1);
namespace example\caledonia\application;

use example\framework\http\Request;

require __DIR__ . '/../vendor/autoload.php';

(new ApplicationFactory)
    ->createApplication()
    ->run(Request::fromSuperGlobals())
    ->send();
