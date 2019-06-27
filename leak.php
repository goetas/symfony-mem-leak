#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$f = function () {
    include 'cache.php';
};

foreach (range(1, 5000) as $i) {

    $f();

    gc_collect_cycles();
    if (!($i % 100)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


