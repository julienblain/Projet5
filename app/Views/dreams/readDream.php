<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
    <section id="readDream">

        <div id="readTitlteBox">
            <h2 id="readDream-title" class="ru-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
            <p id="readDream-date"><?= $dream[0]->hourDreamsFr ?></p>
        </div>

        <article id="readDream-dream">
            <p class="ru-dream"><?= $dream[0]->content ?></p>
        </article>

        <?php
        if ($dream[0]->elaboration !== null) {
            echo '
    <aside id="readDreamElaboration" class="read-aside">
        <p id="read-aside-elaboration">Élaboration</p>
        <div>
            <p id="readDream-elaboration" class="ru-elaboration">' . $dream[0]->elaboration . '</p>
        </div>
    </aside>';
        }
        ?>

        <?php
        if ($dream[0]->previousEvents !== null) {
            echo '
    <aside id="readDreamPreviousEvents" class="read-aside">
        <p id="read-aside-events">Évenements précédents</p>
        <div>
            <p id="readDream-previousEvents" class="ru-previousEvents">' . $dream[0]->previousEvents . '</p>
        </div>
    </aside>';
        }
        ?>

        <div id="btnAction">
            <a href="?p=dreams.update.<?= $dream[0]->id ?>">
                <button id="readDream-update" class="btn btnUpdate">
                    <i class="fa fa-wrench"></i>
                </button>
            </a>

            <a href="?p=dreams.delete.<?= $dream[0]->id ?>">
                <button id="readDream-delete" class="btn btnDelete">
                    <i class="fa fa-trash"></i>
                </button>
            </a>

            <?php include_once($this->viewPath . 'dreams/btnPreviousAndNextDream.php'); ?>
        </div>
    </section>


<?php include_once($this->viewPath . 'dreams/search.php'); ?>