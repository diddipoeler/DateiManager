<?php

declare(strict_types=1);

?>
<footer class="footer border-top">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">

                <small>

                    © <?= date('Y') ?>

                    DateiManager

                </small>

            </div>

            <div class="col-md-6 text-end">

                <small>

                    Version

                    <?= \App\Core\Config::VERSION ?>

                </small>

            </div>

        </div>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/app.js"></script>