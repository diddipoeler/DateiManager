<?php

declare(strict_types=1);

namespace App\Services;

final class MimeService
{
    public static function get(string $file): string
    {
        if (!is_file($file)) {
            return 'application/octet-stream';
        }

        return mime_content_type($file)
            ?: 'application/octet-stream';
    }
}