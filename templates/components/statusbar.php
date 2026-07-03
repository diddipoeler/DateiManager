<?php

declare(strict_types=1);

?>

<div class="card mt-3">

    <div class="card-body">

        <div class="row text-center">

            <div class="col">

                <strong>

                    <?= $statistics['folders'] ?>

                </strong>

                <br>

                Ordner

            </div>

            <div class="col">

                <strong>

                    <?= $statistics['files'] ?>

                </strong>

                <br>

                Dateien

            </div>

            <div class="col">

                <strong>

                    <?= $statistics['size_human'] ?>

                </strong>

                <br>

                Größe

            </div>

        </div>

    </div>

</div>