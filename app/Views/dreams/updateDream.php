<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="updateDream">

    <h2 id="readDream-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
    <h3>Modifier</h3>
    <form action="?p=dreams.updated.<?= $dream[0]->idDreams ?>" id="updated" method="post">
        <fieldset id="updateDream-dream">
            <legend>Rêve</legend>
            <label for="dream">
                <textarea name="dream" id="dreamUpdated" required ><?= $dream[0]->dreamDreams ?></textarea> <!--verifier si le required fonctionne sur safari -->
            </label>


            <?php
            //TODO penser que la date risque de bugger sur safari et ie
            ?>
            <label for="dreamDate"> Date :
                <input type="date" name="dreamDate" id="dateUpdated" value="<?php echo $dream[0]->dateDreams; ?>" >
            </label>
            <label for="dreamHour"> Heure :
                <input type="time" id="hourUpdated" name="dreamHour" value="<?php echo $dream[0]->hourDreams; ?>">
            </label>
        </fieldset>


        <fieldset id="updateDream-elaboration">
            <legend>Élaboration</legend>
            <label for="elaboration">
                <textarea name="elaboration" id="elaborationUpdated"><?= $dream[0]->elaborationDreams ?></textarea>
            </label>
        </fieldset>

        <fieldset id="updateDream-previousEvents">
            <legend>Évènements précédents</legend>
            <label for="previousEvents">
                <textarea name="previousEvents" id="previousEventsUpdated"><?= $dream[0]->previousEventsDreams?></textarea>
            </label>
        </fieldset>

        <button id="updateDream-submit" type="submit">Modifier</button>
    </form>


    <button id="updateDream-read"><a href="?p=dreams.read.<?= $dream[0]->idDreams ?>">Lire</a></button>
    <button id="updateDream-delete"><a href="?p=dreams.delete.<?= $dream[0]->idDreams ?>">Supprimer</a></button>

    <?php include_once ($this->viewPath. 'dreams/btnPreviousAndNextDream.php'); ?>

</section>