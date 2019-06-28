<?php

class A {

    public function getService()
    {
        return include 'serviceDef.php';
    }
}

class B {

    public $test;
}


for ($i = 0; $i<10000; $i++) {

    $a = new A();
    $a->getService();

    gc_collect_cycles();
    if (!($i % 100)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


