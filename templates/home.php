<?php

declare(strict_types=1);

use App\Helpers\Helpers;

/*
|--------------------------------------------------------------------------
| Daten
|--------------------------------------------------------------------------
*/

$statistics = $statistics ?? [];
$breadcrumb = $breadcrumb ?? [];
$items = $items ?? [];

?>

<div class="container-fluid">

    <!-- Breadcrumb -->

    <div class="row mt-3">

        <div class="col">

            <nav>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item">

                        <a href="index.php">

                            <i class="bi bi-house"></i>

                        </a>

                    </li>

                    <?php foreach ($breadcrumb as $crumb): ?>

                        <li class="breadcrumb-item">

                            <a href="?dir=<?= urlencode($crumb['path']) ?>">

                                <?= Helpers::e($crumb['name']) ?>

                            </a>

                        </li>

                    <?php endforeach; ?>

                </ol>

            </nav>

        </div>

    </div>

    <!-- Kopf -->

    <div class="row mb-3">

        <div class="col">

            <h3>

                <i class="bi bi-folder2-open"></i>

                <?= Helpers::e($manager->getCurrentDirectory()) ?>

            </h3>

        </div>

    </div>

    <!-- Grid -->

    <div class="row">

        <?php if (empty($items)): ?>

            <div class="col">

                <div class="alert alert-info">

                    Dieses Verzeichnis ist leer.

                </div>

            </div>

        <?php endif; ?>

        <?php foreach ($items as $item): ?>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">

                <div class="card file-card shadow-sm">

                    <div class="card-body">

                        <div class="text-center mb-3">

                            <i class="bi <?= Helpers::e($item['icon']) ?> fs-1"></i>

                        </div>

                        <h6
                            class="card-title text-truncate"
                            title="<?= Helpers::e($item['name']) ?>">

                            <?= Helpers::e($item['name']) ?>

                        </h6>

                        <div class="small text-muted">

                            <?= Helpers::e($item['type']) ?>

                        </div>

                        <hr>

                        <?php if ($item['is_dir']): ?>

                            <a
                                class="btn btn-primary btn-sm w-100"

                                href="?dir=<?= urlencode($item['path']) ?>">

                                Öffnen

                            </a>

                        <?php else: ?>

                            <div class="small">

                                Größe

                                <strong>

                                    <?= Helpers::e($item['size_human']) ?>

                                </strong>

                            </div>

                        <?php endif; ?>

                        <div class="small mt-2">

                            <?= Helpers::e($item['modified_human']) ?>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- Status -->

    <div class="row mt-3">

        <div class="col">

            <div class="alert alert-light border">

                <strong>

                    <?= $statistics['folders'] ?? 0 ?>

                </strong>

                Ordner

                &nbsp;&nbsp;

                <strong>

                    <?= $statistics['files'] ?? 0 ?>

                </strong>

                Dateien

                &nbsp;&nbsp;

                <strong>

                    <?= $statistics['size_human'] ?? '0 B' ?>

                </strong>

            </div>

        </div>

    </div>

</div>