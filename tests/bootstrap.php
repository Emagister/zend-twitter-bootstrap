<?php

if (!file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    die('Before executing unit tests, you must install the dependencies!!' . PHP_EOL);
}

require_once dirname(__DIR__) . '/vendor/autoload.php';