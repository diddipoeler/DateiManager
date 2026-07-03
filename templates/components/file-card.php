<?php

declare(strict_types=1);

use App\Helpers\Helpers;

/** @var array $item */
/** @var App\Core\FileManager $manager */

$search = trim((string) ($_GET['search'] ?? ''));
$sort = trim((string) ($_GET['sort'] ?? 'name'));
$direction = trim((string) ($_GET['direction'] ?? 'asc'));
$view = trim((string) ($_GET['view'] ?? 'grid'));

$link = '#';

if ($item['is_dir']) {
    $parameters = [
        'dir' => $item['path'],
        'search' => $search,
        'sort' => $sort,
        'direction' => $direction,
        'view' => $view,
    ];

    $parameters = array_filter(
        $parameters,
        static fn (string $value): bool => $value !== ''
    );

    $link = '?' . http_build_query($parameters);
}

?>

<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

    <div class="card h-100 shadow-sm file-card">

        <div class="card-body text-center">

            <div class="display-4 mb-3">

                <i class="bi <?= Helpers::e($item['icon']) ?>"></i>

            </div>

            <h6
                class="card-title text-truncate"
                title="<?= Helpers::e($item['name']) ?>">

                <?= Helpers::e($item['name']) ?>

            </h6>

            <p class="small text-muted mb-2">

                <?= Helpers::e($item['type']) ?>

            </p>

            <?php if (!$item['is_dir']): ?>

                <p class="small mb-1">

                    <?= Helpers::e($item['size_human']) ?>

                </p>

            <?php endif; ?>

            <p class="small text-muted">

                <?= Helpers::e($item['modified_human']) ?>

            </p>

        </div>

        <div class="card-footer bg-white border-0">

            <?php if ($item['is_dir']): ?>

                <a
                    href="<?= Helpers::e($link) ?>"
                    class="btn btn-primary w-100">

                    <i class="bi bi-folder2-open"></i>

                    Öffnen

                </a>

            <?php else: ?>

                <button
                    class="btn btn-outline-secondary w-100"
                    disabled>

                    <i class="bi bi-file-earmark"></i>

                    Datei

                </button>

            <?php endif; ?>

        </div>

    </div>

</div>
