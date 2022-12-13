<?php

use App\Year2022\Day11MonkeyInTheMiddle\Part01\Handler;

require __DIR__ . '/vendor/autoload.php';

$container = new DI\Container();
$handler = $container->get(Handler::class);
$result = $handler->run();

var_dump($result);
