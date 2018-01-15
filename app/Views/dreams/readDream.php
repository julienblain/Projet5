<?php include_once ($this->viewPath. 'dreams/nav.php');var_dump($dream)?>
<section id="readDream">

    <h2 id="readDream-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
    <article id="readDream-dream">
        <?= $dream[0]->dreamDreams ?>
    </article>
    <aside id="readDream-elaboration"><?= $dream[0]->elaborationDreams ?></aside>
    <aside id="readDream-previousEvents"><?= $dream[0]->previousEventsDreams ?></aside>
    <button id="readDream-update"><a href="?p=dreams.update.<?= $_GET['p'][-1] ?>">Modifier</a></button>
    <button id="readDream-delete"><a href="?p=dreams.delete.<?= $_GET['p'][-1] ?>">Supprimer</a></button>
</section>
