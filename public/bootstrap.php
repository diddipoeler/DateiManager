<?php

declare(strict_types=1);

use App\Core\Config;

if (PHP_VERSION_ID < 80200) {
    exit('PHP 8.2 oder höher wird benötigt.');
}

require dirname(__DIR__) . '/vendor/autoload.php';

Config::init();

date_default_timezone_set(Config::TIMEZONE);
mb_internal_encoding('UTF-8');

if (Config::DEBUG) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

header('Content-Type: text/html; charset=UTF-8');
