<!doctype html>
<html lang="de">

<?php require __DIR__.'/header.php'; ?>

<body>

<div class="wrapper">

    <?php require __DIR__.'/sidebar.php'; ?>

    <main class="content">

        <?php require $view; ?>

    </main>

</div>

<?php require __DIR__.'/footer.php'; ?>

</body>
</html>
