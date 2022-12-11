<?php

use App\Year2022\Day10CathodeRayTube\Part02\Part02;

require __DIR__ . '/vendor/autoload.php';

$container = new DI\Container();
$handler = $container->get(Part02::class);
$handler->run();
