<?php

declare(strict_types=1);

namespace App\Services;

final class IconService
{
    public static function icon(string $type): string
    {
        return match ($type) {

            'folder'      => 'bi-folder-fill text-warning',

            'image'       => 'bi-file-image text-success',

            'video'       => 'bi-file-play text-danger',

            'audio'       => 'bi-file-music text-primary',

            'pdf'         => 'bi-file-pdf text-danger',

            'archive'     => 'bi-file-zip text-dark',

            'code'        => 'bi-file-code text-info',

            'text'        => 'bi-file-text text-secondary',

            'word'        => 'bi-file-word text-primary',

            'excel'       => 'bi-file-excel text-success',

            'powerpoint'  => 'bi-file-ppt text-warning',

            default       => 'bi-file-earmark text-muted',

        };
    }
}