<?php

declare(strict_types=1);

namespace App\Services;

final class PreviewService
{
    public static function supported(string $type): bool
    {
        return in_array($type, [

            'image',
            'video',
            'audio',
            'pdf',
            'text',
            'code'

        ], true);
    }

    public static function isImage(string $type): bool
    {
        return $type === 'image';
    }

    public static function isVideo(string $type): bool
    {
        return $type === 'video';
    }

    public static function isAudio(string $type): bool
    {
        return $type === 'audio';
    }

    public static function isPdf(string $type): bool
    {
        return $type === 'pdf';
    }

    public static function isText(string $type): bool
    {
        return in_array($type, [

            'text',
            'code'

        ], true);
    }
}