#!/usr/bin/env php
<?php

use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Reference;

set_time_limit(0);

require __DIR__ . '/vendor/autoload.php';
error_reporting(22527);

$di = new ContainerBuilder();

$a = new Definition('stdClass');
$a->setPublic(true);
$di->setDefinition('a', $a);

$b = new Definition('stdClass');
$b->addArgument(new IteratorArgument([new Reference('a')]));
$b->setPublic(true);
$b->setShared(false);
$di->setDefinition('b', $b);

$di->compile();

$dumper = new PhpDumper($di);
$files = $dumper->dump(['as_files' => true, 'namespace' => 'TestLeak', 'class' => 'LeakDI']);
foreach ($files as $file => $content) {
    @mkdir(dirname($file));
    file_put_contents($file, $content);
}
require __DIR__. '/LeakDI.php';

$container  = new TestLeak\LeakDI();
foreach (range(1, 10000) as $i) {

    $container->get('b');

    gc_collect_cycles();
    if (!($i % 100)) {
        echo round(memory_get_usage() / 1024 / 1024, 6) . PHP_EOL;
    }
}


