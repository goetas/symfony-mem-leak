<?php

$f = function () {
    include 'cache.php';
};

for ($i = 0; $i<10000; $i++) {

    $f();

    gc_collect_cycles();
    if (!($i % 100)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


