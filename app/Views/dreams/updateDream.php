<?php include_once ($this->viewPath. 'dreams/nav.php'); ?>
<section id="updateDream">
    <div id="updateDream-title">
        <h2 id="updateDream-title" class="ru-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
        <h3>Modifier</h3>
    </div>
    <form action="?p=dreams.updated.<?= $dream[0]->id ?>" id="updateDream-updated" method="post">
        <fieldset id="updateDream-dream">
            <label for="dream">
                <textarea name="dream" id="dreamUpdated" class="ru-dream" required ><?= $dream[0]->content ?></textarea> <!--verifier si le required fonctionne sur safari -->
            </label>
        </fieldset>

            <?php
            //TODO penser que la date risque de bugger sur safari et ie
            ?>
        <fieldset id="dateTime">
            <label for="dreamDate" id="dateTime-dreamDate">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <input type="date" name="dreamDate" id="dreamDate" value="<?php echo $dream[0]->date; ?>" >
            </label>
            <label for="dreamHour" id="dateTime-dreamHour">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <input type="time" id="dreamDate" name="dreamHour" value="<?php echo $dream[0]->hour; ?>">
            </label>
        </fieldset>


        <div id="moreElements">
            <p id="elaborationTxt">Élaboration</p>
            <p id="previousEventsTxt">Évènements précédents</p>
        </div>

        <fieldset id="elaboration">
            <label for="elaboration">
                <textarea name="elaboration" id="elaborationTextarea"><?= $dream[0]->elaboration ?></textarea>
            </label>
        </fieldset>

        <fieldset id="previousEvents">
            <label for="previousEvents">
                <textarea name="previousEvents" id="previousEventsWrite"><?= $dream[0]->previousEvents ?></textarea>
            </label>
        </fieldset>

        <button id="submitDream" class="btn" type="submit">
            <i class="fa fa-check"></i>
        </button>
    </form>

    <div id="btnAction">
        <button id="updateDream-read" class="btn btnRead">
            <a href="?p=dreams.read.<?= $dream[0]->id ?>">
                <i class="fa fa-file"></i>
            </a>
        </button>
        <button id="updateDream-delete" class="btn btnDelete">
            <a href="?p=dreams.delete.<?= $dream[0]->id ?>">
                <i class="fa fa-trash"></i>
            </a>
        </button>

    <?php include_once ($this->viewPath. 'dreams/btnPreviousAndNextDream.php'); ?>
    </div>
</section>

<?php include_once ($this->viewPath. 'dreams/search.php'); ?>