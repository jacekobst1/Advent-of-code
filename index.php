<?php

use App\Year2022\Day07NoSpaceLeftOnDevice\Part02;

require __DIR__ . '/vendor/autoload.php';

$container = new DI\Container();
$handler = $container->get(Part02::class);
$result = $handler->run();

var_dump($result);
