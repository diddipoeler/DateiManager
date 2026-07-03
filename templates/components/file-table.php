<?php

declare(strict_types=1);

use App\Helpers\Helpers;

$search = trim((string) ($_GET['search'] ?? ''));
$sort = trim((string) ($_GET['sort'] ?? 'name'));
$direction = trim((string) ($_GET['direction'] ?? 'asc'));
$view = trim((string) ($_GET['view'] ?? 'list'));

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

<div class="card shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

            <tr>

                <th style="width:50px"></th>

                <th>Name</th>

                <th>Typ</th>

                <th>Größe</th>

                <th>Geändert</th>

                <th style="width:120px"></th>

            </tr>

            </thead>

            <tbody>

            <?php foreach ($items as $item): ?>

                <tr>

                    <td>

                        <i class="bi <?= Helpers::e($item['icon']) ?> fs-4"></i>

                    </td>

                    <td>

                        <?php if ($item['is_dir']): ?>

                            <a href="<?= Helpers::e($buildUrl($item['path'])) ?>">

                                <?= Helpers::e($item['name']) ?>

                            </a>

                        <?php else: ?>

                            <?= Helpers::e($item['name']) ?>

                        <?php endif; ?>

                    </td>

                    <td>

                        <?= Helpers::e($item['type']) ?>

                    </td>

                    <td>

                        <?= Helpers::e($item['size_human']) ?>

                    </td>

                    <td>

                        <?= Helpers::e($item['modified_human']) ?>

                    </td>

                    <td>

                        <?php if ($item['is_dir']): ?>

                            <a
                                class="btn btn-sm btn-primary"
                                href="<?= Helpers::e($buildUrl($item['path'])) ?>">

                                Öffnen

                            </a>

                        <?php else: ?>

                            <button
                                class="btn btn-sm btn-outline-secondary"
                                disabled>

                                Datei

                            </button>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

