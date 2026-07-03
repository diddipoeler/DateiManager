<?php

declare(strict_types=1);

use App\Helpers\Helpers;

/**
 * Breadcrumb-Komponente
 *
 * Erwartet:
 * $manager
 */

$breadcrumbs = $manager->breadcrumb();

$search = trim((string) ($_GET['search'] ?? ''));
$sort = trim((string) ($_GET['sort'] ?? 'name'));
$direction = trim((string) ($_GET['direction'] ?? 'asc'));
$view = trim((string) ($_GET['view'] ?? 'grid'));

$buildUrl = static function (string $directory) use (
    $search,
    $sort,
    $direction,
    $view
): string {
    $parameters = [
        'dir' => $directory,
        'search' => $search,
        'sort' => $sort,
        'direction' => $direction,
        'view' => $view,
    ];

    $parameters = array_filter(
        $parameters,
        static fn (string $value): bool => $value !== ''
    );

    return '?' . http_build_query($parameters);
};

?>

<nav aria-label="breadcrumb" class="mb-3">

    <ol class="breadcrumb">

        <li class="breadcrumb-item">

            <a href="<?= Helpers::e($buildUrl('')) ?>">

                <i class="bi bi-house-door-fill"></i>

                Home

            </a>

        </li>

        <?php foreach ($breadcrumbs as $crumb): ?>

            <li class="breadcrumb-item">

                <a href="<?= Helpers::e($buildUrl($crumb['path'])) ?>">

                    <?= Helpers::e($crumb['name']) ?>

                </a>

            </li>

        <?php endforeach; ?>

    </ol>

</nav>