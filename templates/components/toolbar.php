<?php

declare(strict_types=1);

use App\Helpers\Helpers;

$search = $search ?? '';
$view = $view ?? 'grid';

$sort = trim((string) ($_GET['sort'] ?? 'name'));
$direction = trim((string) ($_GET['direction'] ?? 'asc'));

$query = static function (array $overrides = []) use (
    $manager,
    $search,
    $view,
    $sort,
    $direction
): string {
    $parameters = array_merge([
        'dir' => $manager->getCurrentDirectory(),
        'search' => $search,
        'view' => $view,
        'sort' => $sort,
        'direction' => $direction,
    ], $overrides);

    $parameters = array_filter(
        $parameters,
        static fn (string $value): bool => $value !== ''
    );

    return '?' . http_build_query($parameters);
};

?>

<div class="card shadow-sm mb-3">

    <div class="card-body">

        <div class="row g-2 align-items-center">

            <div class="col-md">

                <form method="get">

                    <input
                        type="hidden"
                        name="dir"
                        value="<?= Helpers::e($manager->getCurrentDirectory()) ?>">

                    <input
                        type="hidden"
                        name="view"
                        value="<?= Helpers::e($view) ?>">

                    <input
                        type="hidden"
                        name="sort"
                        value="<?= Helpers::e($sort) ?>">

                    <input
                        type="hidden"
                        name="direction"
                        value="<?= Helpers::e($direction) ?>">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            class="form-control"
                            type="search"
                            name="search"
                            placeholder="Dateien suchen..."
                            value="<?= Helpers::e($search) ?>">

                        <button class="btn btn-primary" type="submit">
                            Suchen
                        </button>

                    </div>

                </form>

            </div>

            <div class="col-auto">

                <div class="btn-group">

                    <a
                        class="btn btn-outline-secondary <?= $view === 'grid' ? 'active' : '' ?>"
                        href="<?= Helpers::e($query(['view' => 'grid'])) ?>">

                        <i class="bi bi-grid-3x3-gap-fill"></i>

                    </a>

                    <a
                        class="btn btn-outline-secondary <?= $view === 'list' ? 'active' : '' ?>"
                        href="<?= Helpers::e($query(['view' => 'list'])) ?>">

                        <i class="bi bi-list-ul"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

