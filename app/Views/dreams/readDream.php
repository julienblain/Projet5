<?php include_once ($this->viewPath. 'dreams/nav.php'); ?>
<section id="readDream">

    <h2 id="readDream-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
    <p id="readDream-date"><?= $dream[0]->hourDreamsFr ?></p>
    <article id="readDream-dream">
        <?= $dream[0]->content ?>
    </article>
    <aside id="readDream-elaboration"><?= $dream[0]->elaboration ?></aside>
    <aside id="readDream-previousEvents"><?= $dream[0]->previousEvents ?></aside>
    <button id="readDream-update"><a href="?p=dreams.update.<?= $dream[0]->id ?>">Modifier</a></button>
    <button id="readDream-delete"><a href="?p=dreams.delete.<?= $dream[0]->id ?>">Supprimer</a></button>

    <?php include_once ($this->viewPath. 'dreams/btnPreviousAndNextDream.php'); ?>

</section>


<?php include_once ($this->viewPath. 'dreams/search.php'); ?>