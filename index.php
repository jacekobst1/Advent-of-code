<?php

use App\Year2022\Day07NoSpaceLeftOnDevice\Part01;

require __DIR__ . '/vendor/autoload.php';

$container = new DI\Container();
$handler = $container->get(Part01::class);
$result = $handler->run();

var_dump($result);
