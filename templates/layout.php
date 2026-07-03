<?php

declare(strict_types=1);

use App\Core\Config;
use App\Helpers\Helpers;

$pageTitle = $title ?? Config::APP_NAME;

?>
<!doctype html>
<html lang="de">
<head>
    <?php require __DIR__ . '/header.php'; ?>
</head>
<body>

<div class="app-wrapper">

    <?php require __DIR__ . '/sidebar.php'; ?>

    <main class="app-main">

        <?php require __DIR__ . '/' . $view . '.php'; ?>

    </main>

</div>

<?php require __DIR__ . '/footer.php'; ?>

</body>
</html>