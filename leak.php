#!/usr/bin/env php
<?php

set_time_limit(0);

require __DIR__ . '/vendor/autoload.php';


$f = function () {
    $files = new \Symfony\Component\Cache\Adapter\PhpFilesAdapter('C4wL-F1oiZ', 0, '/home/goetas/projects/leak/var/cache/prod/pools', 1);
    $array = new \Symfony\Component\Cache\Adapter\PhpArrayAdapter('/home/goetas/projects/leak/var/cache/prod/annotations.php', $files);

    $preovider = new Symfony\Component\Cache\DoctrineProvider($array);

    // The callable will only be executed on a cache miss.
    $preovider->fetch( 'App\Controller\DefaultController#leak');
};

foreach (range(1, 5000) as $i) {

    $f();

    gc_collect_cycles();
    if (!($i % 100)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


