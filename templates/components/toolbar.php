<?php

declare(strict_types=1);

use App\Helpers\Helpers;

$search = $search ?? '';
$view   = $view ?? 'grid';
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

                        <button
                            class="btn btn-primary">

                            Suchen

                        </button>

                    </div>

                </form>

            </div>

            <div class="col-auto">

                <div class="btn-group">

                    <a
                        class="btn btn-outline-secondary <?= $view === 'grid' ? 'active' : '' ?>"
                        href="?dir=<?= urlencode($manager->getCurrentDirectory()) ?>&view=grid">

                        <i class="bi bi-grid-3x3-gap-fill"></i>

                    </a>

                    <a
                        class="btn btn-outline-secondary <?= $view === 'list' ? 'active' : '' ?>"
                        href="?dir=<?= urlencode($manager->getCurrentDirectory()) ?>&view=list">

                        <i class="bi bi-list-ul"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>