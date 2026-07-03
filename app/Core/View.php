<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

final class View
{
    public static function render(string $template, array $data = []): void
    {
        $file = Config::$templates . '/' . $template . '.php';

        if (!is_file($file)) {
            throw new RuntimeException("Template {$template} wurde nicht gefunden.");
        }

        extract($data, EXTR_SKIP);
        require $file;
    }
}
