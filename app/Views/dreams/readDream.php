<?php include_once ($this->viewPath. 'dreams/nav.php'); ?>
<section id="readDream">

    <h2 id="readDream-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
    <p id="readDream-date"><?= $dream[0]->hourDreamsFr ?></p>
    <article id="readDream-dream">
        <?= $dream[0]->dreamDreams ?>
    </article>
    <aside id="readDream-elaboration"><?= $dream[0]->elaborationDreams ?></aside>
    <aside id="readDream-previousEvents"><?= $dream[0]->previousEventsDreams ?></aside>
    <button id="readDream-update"><a href="?p=dreams.update.<?= $dream[0]->idDreams ?>">Modifier</a></button>
    <button id="readDream-delete"><a href="?p=dreams.delete.<?= $dream[0]->idDreams ?>">Supprimer</a></button>

    <?php include_once ($this->viewPath. 'dreams/btnPreviousAndNextDream.php'); ?>
    <?php include_once ($this->viewPath. 'dreams/search.php'); ?>

</section>
