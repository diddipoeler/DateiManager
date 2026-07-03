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

?>

<nav aria-label="breadcrumb" class="mb-3">

    <ol class="breadcrumb">

        <li class="breadcrumb-item">

            <a href="index.php">

                <i class="bi bi-house-door-fill"></i>

                Home

            </a>

        </li>

        <?php foreach ($breadcrumbs as $crumb): ?>

            <li class="breadcrumb-item">

                <a href="?dir=<?= urlencode($crumb['path']) ?>">

                    <?= Helpers::e($crumb['name']) ?>

                </a>

            </li>

        <?php endforeach; ?>

    </ol>

</nav>