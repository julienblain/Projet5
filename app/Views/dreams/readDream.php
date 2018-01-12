<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="readDream">
    <?php var_dump($dream);
    var_dump($dateTime);
    ?>

    <h2 id="readDream-title">Rêve du <?= $dateTime[0] . ' à ' . $dateTime[1]?></h2>
    <article id="readDream-dream">
        <?= $dream[0]->dreamDreams ?>
    </article>
    <aside id="readDream-elaboration"><?= $dream[0]->elaborationDreams ?></aside>
    <aside id="readDream-previousEvents"><?= $dream[0]->previousEventsDreams ?></aside>
</section>
