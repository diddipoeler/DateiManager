<?php
use App\Core\Config;
use App\Helpers\Helpers;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-folder2-open me-2"></i><?= Helpers::e(Config::APP_NAME) ?>
        </a>
        <span class="navbar-text small">v<?= Helpers::e(Config::VERSION) ?></span>
    </div>
</nav>
