<?php

declare(strict_types=1);

use App\Helpers\Helpers;

/*
|--------------------------------------------------------------------------
| Sidebar
|--------------------------------------------------------------------------
|
| Diese Navigation wird später dynamisch erweitert.
|
*/
?>

<aside class="sidebar">

    <div class="sidebar-header">

        <h5>

            <i class="bi bi-folder2-open"></i>

            DateiManager

        </h5>

    </div>

    <nav class="sidebar-nav">

        <ul class="nav flex-column">

            <li class="nav-item">

                <a
                    class="nav-link active"
                    href="index.php">

                    <i class="bi bi-house-door"></i>

                    Home

                </a>

            </li>

            <li class="nav-item">

                <a
                    class="nav-link"
                    href="?dir=<?= urlencode($manager->getRoot()) ?>">

                    <i class="bi bi-folder-fill"></i>

                    Dateien

                </a>

            </li>

            <li class="nav-item">

                <a
                    class="nav-link"
                    href="#">

                    <i class="bi bi-upload"></i>

                    Uploads

                </a>

            </li>

            <li class="nav-item">

                <a
                    class="nav-link"
                    href="#">

                    <i class="bi bi-images"></i>

                    Bilder

                </a>

            </li>

            <li class="nav-item">

                <a
                    class="nav-link"
                    href="#">

                    <i class="bi bi-file-earmark-text"></i>

                    Dokumente

                </a>

            </li>

        </ul>

    </nav>

    <hr>

    <div class="sidebar-footer">

        <div class="small text-muted">

            Version

            <?= Helpers::e(Config::VERSION) ?>

        </div>

    </div>

</aside>