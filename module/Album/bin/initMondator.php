#!/usr/bin/env php
<?php

$moduleName = basename(dirname(__DIR__));

chdir(dirname(dirname(dirname(__DIR__))));

// Setup autoloading
require 'vendor/autoload.php';

$initMondatorFactory = new \Zf2mandango\Mondator\Init\Factory();
$initMondatorFactory
    ->getInstance($moduleName . '\\Mondator', require 'config/application.config.php')
    ->process()
;
