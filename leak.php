#!/usr/bin/env php
<?php

set_time_limit(0);

require __DIR__ . '/vendor/autoload.php';
error_reporting(22527);

$f = function () {
    $files = new \Symfony\Component\Cache\Adapter\PhpFilesAdapter('C4wL-F1oiZ', 0, '/home/goetas/projects/leak/var/cache/prod/pools', 1);

    $files->get('%5BApp%5CController%5CDefaultController%23leak%5D%5B1%5D', function (){

    });
};

foreach (range(1, 5000) as $i) {

    $f();

    gc_collect_cycles();
    if (!($i % 100)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


