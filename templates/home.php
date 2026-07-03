<?php

declare(strict_types=1);

?>

<div class="container-fluid">

    <?php require __DIR__ . '/components/breadcrumb.php'; ?>

    <?php require __DIR__ . '/components/toolbar.php'; ?>

    <?php if (empty($items)): ?>

        <div class="alert alert-info">

            Dieses Verzeichnis enthält keine Dateien.

        </div>

    <?php else: ?>

        <div class="row">

            <?php foreach ($items as $item): ?>

                <?php require __DIR__ . '/components/file-card.php'; ?>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <?php require __DIR__ . '/components/statusbar.php'; ?>

</div>