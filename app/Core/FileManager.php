<?php

declare(strict_types=1);

namespace App\Core;

use DirectoryIterator;
use RuntimeException;

final class FileManager
{
    private string $root;
    private string $currentDirectory;

    public function __construct(string $rootDirectory)
    {
        $realPath = realpath($rootDirectory);

        if ($realPath === false || !is_dir($realPath)) {
            throw new RuntimeException('Das Basisverzeichnis existiert nicht.');
        }

        $this->root = rtrim($realPath, DIRECTORY_SEPARATOR);
        $this->currentDirectory = $this->root;
    }

    public function setDirectory(?string $directory): void
    {
        if (empty($directory)) {
            $this->currentDirectory = $this->root;
            return;
        }

        $realPath = realpath($directory);

        if ($realPath === false || !is_dir($realPath)) {
            $this->currentDirectory = $this->root;
            return;
        }

        if (!str_starts_with($realPath, $this->root)) {
            $this->currentDirectory = $this->root;
            return;
        }

        $this->currentDirectory = $realPath;
    }

    public function getRoot(): string
    {
        return $this->root;
    }

    public function getCurrentDirectory(): string
    {
        return $this->currentDirectory;
    }

    public function isRoot(): bool
    {
        return $this->currentDirectory === $this->root;
    }

    public function parentDirectory(): string
    {
        if ($this->isRoot()) {
            return $this->root;
        }

        $parent = dirname($this->currentDirectory);

        return str_starts_with($parent, $this->root)
            ? $parent
            : $this->root;
    }

    public function listDirectory(): array
    {
        $items = [];

        foreach (new DirectoryIterator($this->currentDirectory) as $item) {
            if ($item->isDot()) {
                continue;
            }

            if (!$this->showHiddenFiles() && str_starts_with($item->getFilename(), '.')) {
                continue;
            }

            $items[] = $this->formatItem($item);
        }

        return $items;
    }

    public function search(array $items, string $query): array
    {
        $query = trim($query);

        if ($query === '') {
            return $items;
        }

        return array_values(array_filter(
            $items,
            fn (array $item): bool => stripos($item['name'], $query) !== false
        ));
    }

    public function sort(array &$items, string $field = 'name', string $direction = 'asc'): void
    {
        $allowedFields = ['name', 'size', 'date', 'type'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($field, $allowedFields, true)) {
            $field = 'name';
        }

        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'asc';
        }

        usort($items, function (array $a, array $b) use ($field, $direction): int {
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            }

            if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            }

            $result = match ($field) {
                'size' => ($a['size'] ?? 0) <=> ($b['size'] ?? 0),
                'date' => $a['modified'] <=> $b['modified'],
                'type' => strcmp($a['type'], $b['type']),
                default => strcasecmp($a['name'], $b['name']),
            };

            return $direction === 'desc' ? -$result : $result;
        });
    }

    public function breadcrumb(): array
    {
        if ($this->isRoot()) {
            return [];
        }

        $relative = trim(
            str_replace($this->root, '', $this->currentDirectory),
            DIRECTORY_SEPARATOR
        );

        if ($relative === '') {
            return [];
        }

        $parts = explode(DIRECTORY_SEPARATOR, $relative);
        $path = $this->root;
        $crumbs = [];

        foreach ($parts as $part) {
            $path .= DIRECTORY_SEPARATOR . $part;

            $crumbs[] = [
                'name' => $part,
                'path' => $path,
            ];
        }

        return $crumbs;
    }

    public function statistics(array $items): array
    {
        $folders = 0;
        $files = 0;
        $size = 0;

        foreach ($items as $item) {
            if ($item['is_dir']) {
                $folders++;
                continue;
            }

            $files++;
            $size += (int) $item['size'];
        }

        return [
            'folders' => $folders,
            'files' => $files,
            'size' => $size,
            'size_human' => $this->formatBytes($size),
        ];
    }

    private function formatItem(DirectoryIterator $item): array
    {
        $name = $item->getFilename();
        $path = $item->getPathname();
        $isDir = $item->isDir();
        $extension = $isDir ? '' : strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $type = $this->detectType($extension, $isDir);

        return [
            'name' => $name,
            'path' => $path,
            'encoded_path' => urlencode($path),
            'relative_path' => $this->relativePath($path),
            'is_dir' => $isDir,
            'extension' => $extension,
            'type' => $type,
            'icon' => $this->iconForType($type),
            'size' => $isDir ? 0 : $item->getSize(),
            'size_human' => $isDir ? '-' : $this->formatBytes($item->getSize()),
            'modified' => $item->getMTime(),
            'modified_human' => date('d.m.Y H:i', $item->getMTime()),
            'readable' => $item->isReadable(),
            'writable' => $item->isWritable(),
        ];
    }

    private function relativePath(string $path): string
    {
        return ltrim(str_replace($this->root, '', $path), DIRECTORY_SEPARATOR);
    }

    private function detectType(string $extension, bool $isDir): string
    {
        if ($isDir) {
            return 'folder';
        }

        return match ($extension) {
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg' => 'image',
            'mp4', 'webm', 'mov', 'avi', 'mkv' => 'video',
            'mp3', 'wav', 'ogg', 'flac', 'm4a' => 'audio',
            'pdf' => 'pdf',
            'txt', 'md', 'log' => 'text',
            'php', 'html', 'css', 'js', 'json', 'xml', 'sql', 'py', 'java', 'c', 'cpp' => 'code',
            'zip', 'rar', '7z', 'tar', 'gz' => 'archive',
            'doc', 'docx' => 'word',
            'xls', 'xlsx', 'csv' => 'excel',
            'ppt', 'pptx' => 'powerpoint',
            default => 'file',
        };
    }

    private function iconForType(string $type): string
    {
        return match ($type) {
            'folder' => 'bi-folder-fill text-warning',
            'image' => 'bi-file-image text-success',
            'video' => 'bi-file-play text-danger',
            'audio' => 'bi-file-music text-primary',
            'pdf' => 'bi-file-pdf text-danger',
            'text' => 'bi-file-text text-secondary',
            'code' => 'bi-file-code text-info',
            'archive' => 'bi-file-zip text-dark',
            'word' => 'bi-file-word text-primary',
            'excel' => 'bi-file-excel text-success',
            'powerpoint' => 'bi-file-ppt text-warning',
            default => 'bi-file-earmark text-muted',
        };
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = 0;

        while ($bytes >= 1024 && $index < count($units) - 1) {
            $bytes /= 1024;
            $index++;
        }

        return round($bytes, 2) . ' ' . $units[$index];
    }

    private function showHiddenFiles(): bool
    {
        return defined(Config::class . '::SHOW_HIDDEN_FILES')
            ? Config::SHOW_HIDDEN_FILES
            : false;
    }
}
