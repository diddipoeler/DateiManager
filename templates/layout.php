<?php
use App\Core\Config;
use App\Helpers\Helpers;
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Helpers::e($title ?? Config::APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php require __DIR__ . '/header.php'; ?>
<div class="container-fluid">
    <div class="row min-vh-100">
        <?php require __DIR__ . '/sidebar.php'; ?>
        <main class="col-lg-10 col-md-9 p-4 bg-light-subtle">
            <?php require __DIR__ . '/home.php'; ?>
        </main>
    </div>
</div>
<?php require __DIR__ . '/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
