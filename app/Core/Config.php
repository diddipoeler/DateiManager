<?php

declare(strict_types=1);

namespace App\Core;

final class Config
{
    public const APP_NAME = 'PHP DateiManager';
    public const VERSION = '0.1.0';
    public const DEBUG = true;
    public const TIMEZONE = 'Europe/Berlin';

    public static string $root;
    public static string $storage;
    public static string $uploads;
    public static string $cache;
    public static string $thumbs;
    public static string $templates;

    public static function init(): void
    {
        self::$root = dirname(__DIR__, 2);
        self::$storage = self::$root . '/storage';
        self::$uploads = self::$storage . '/uploads';
        self::$cache = self::$storage . '/cache';
        self::$thumbs = self::$storage . '/thumbs';
        self::$templates = self::$root . '/templates';
    }
}
