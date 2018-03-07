<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
<section id="readDream">
    <div id="readTitlteBox">
        <h1 id="readDream-title" class="ru-title"><?= ucfirst($dream[0]->dateDreamsFr) ?></h1>
        <p id="readDream-date"><?= $dream[0]->hourDreamsFr ?></p>
    </div>

    <article id="readDream-dream">
        <p class="ru-dream"><?= $dream[0]->content ?></p>
    </article>

    <?php
    if ($dream[0]->elaboration !== null) {
        echo '
<aside id="readDreamElaboration" class="read-aside">
    <h2 id="read-aside-elaboration">Élaboration</h2>
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
    <h2 id="read-aside-events">Évenements précédents</h2>
    <div>
        <p id="readDream-previousEvents" class="ru-previousEvents">' . $dream[0]->previousEvents . '</p>
    </div>
</aside>';
    }
    ?>

    <div id="btnAction">
        <a href="?p=dreams.update.<?= $dream[0]->id ?>" id="readDream-update" class="btn btnUpdate"
           title="Modifier">
            <i class="fa icon-wrench"></i>
        </a>

        <a href="?p=dreams.delete.<?= $dream[0]->id ?>" id="readDream-delete" class="btn btnDelete"
           title="Supprimer">
            <i class="fa icon-bin2"></i>
        </a>
        <?php include_once($this->viewPath . 'dreams/btnPreviousAndNextDream.php'); ?>
    </div>
</section>
<?php include_once($this->viewPath . 'dreams/search.php'); ?>
