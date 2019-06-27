#!/usr/bin/env php
<?php

set_time_limit(0);

require __DIR__ . '/vendor/autoload.php';


$f = function () {


    $cache = new \Symfony\Component\Cache\Adapter\PhpFilesAdapter('C4wL-F1oiZ', 0, '/home/goetas/projects/leak/var/cache/prod/pools', 1);
    $cache2 = new \Symfony\Component\Cache\Adapter\PhpArrayAdapter('/home/goetas/projects/leak/var/cache/prod/annotations.php', $cache);

    $ad = new Symfony\Component\Cache\DoctrineProvider($cache2);
//
//    // The callable will only be executed on a cache miss.
//    $ad->get('App\Controller\DefaultController#leak"', function ($item) {
//        $item->expiresAfter(3600);
//
//        // ... do some HTTP request or heavy computations
//        $computedValue = 'foobar';
//
//        return $computedValue;
//    });

    // The callable will only be executed on a cache miss.
    $ad->fetch( 'App\Controller\DefaultController#leak');


};

foreach (range(1, 50000) as $i) {

    $f();

    gc_collect_cycles();
    if (!($i % 1000)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


