<?php
use App\Core\Config;
use App\Helpers\Helpers;
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">DateiManager</h1>
        <div class="text-muted">Grundsystem v<?= Helpers::e(Config::VERSION) ?></div>
    </div>
    <div class="btn-group">
        <button class="btn btn-outline-secondary active"><i class="bi bi-grid"></i></button>
        <button class="btn btn-outline-secondary"><i class="bi bi-list"></i></button>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-5 text-center">
        <div class="display-1 text-primary mb-3"><i class="bi bi-folder2-open"></i></div>
        <h2 class="h4">Projekt erfolgreich gestartet</h2>
        <p class="text-muted mb-4">
            Die MVC-Light-Struktur, der Composer-Autoloader und das Grundlayout sind eingerichtet.
        </p>
        <code>storage/uploads</code>
    </div>
</div>
