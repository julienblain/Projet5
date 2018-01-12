<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="updateDream">

    <h2 id="readDream-title">Rêve du <?= $dateTime[0] . ' à ' . $dateTime[1]?></h2>
    <h3>Modifier</h3>
    <form action="?p=dreams.updated.<?= $_GET['p'][-1] ?>" id="updated">
        <fieldset id="updateDream-dream">
            <legend>Rêve</legend>
            <label for="dreamUpdated">
                <textarea name="dreamUpdated" id="dreamUpdated" required ><?= $dream[0]->dreamDreams ?></textarea> <!--verifier si le required fonctionne sur safari -->
            </label>


            <?php
            //TODO penser que la date risque de bugger sur safari et ie
            ?>
            <label for="dateUpdated"> Date :
                <input type="date" name="dateUpdated" id="dateUpdated" value="<?php echo $dream[0]->dateDreams; ?>" >
            </label>
            <label for="hourUpdated"> Heure :
                <input type="time" id="hourUpdated" name="hourUpdated" value="<?php echo $dream[0]->hourDreams; ?>">
            </label>
        </fieldset>


        <fieldset id="updateDream-elaboration">
            <legend>Élaboration</legend>
            <label for="elaborationUpdated">
                <textarea name="elaborationUpdated" id="elaborationUpdated"><?= $dream[0]->elaborationDreams ?></textarea>
            </label>
        </fieldset>

        <fieldset id="updateDream-previousEvents">
            <legend>Évènements précédents</legend>
            <label for="updatedDream-previousEvents">
                <textarea name="updatedDream-previousEvents" id="updatedDream-previousEvents"><?= $dream[0]->previousEventsDreams?></textarea>
            </label>
        </fieldset>

        <button id="updateDream-submit" type="submit">Modifier</button>
    </form>





</section>