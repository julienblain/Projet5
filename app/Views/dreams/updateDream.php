<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
    <section id="updateDream">
        <div id="updateDream-title">
            <h2 class="ru-title">Rêve du <?= $dream[0]->dateDreamsFr ?></h2>
            <h3>Modifier</h3>
        </div>
        <form action="?p=dreams.updated.<?= $dream[0]->id ?>" id="updateDream-updated" method="post">
            <fieldset id="updateDream-dream">
                <label for="dreamUpdated" aria-label="Modifier votre rêve">
                <textarea name="dream" id="dreamUpdated" class="ru-dream"
                          required><?= $dream[0]->content ?></textarea>
                    <!--verifier si le required fonctionne sur safari -->
                </label>
            </fieldset>

            <fieldset id="dateTime">
                <label for="dreamDate" id="dateTime-dreamDate" aria-label="Modifier la date">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <input type="date" name="dreamDate" id="dreamDate" value="<?php echo $dream[0]->date; ?>"
                           title="Modifier la date">
                </label>
                <label for="dreamHour" id="dateTime-dreamHour" aria-label="Modifier l'heure">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <input type="time" id="dreamHour" name="dreamHour" value="<?php echo $dream[0]->hour; ?>"
                           title="Modifier l'heure">
                </label>
            </fieldset>

            <div id="moreElements">
                <p id="elaborationTxt">Élaboration</p>
                <p id="previousEventsTxt">Évènements précédents</p>
            </div>

            <fieldset id="elaboration">
                <label for="elaborationTextarea" aria-label="Modifier l'élaboration">
                    <textarea name="elaboration" id="elaborationTextarea"><?= $dream[0]->elaboration ?></textarea>
                </label>
            </fieldset>

            <fieldset id="previousEvents">
                <label for="previousEventsWrite" aria-label="Modifier les évnements précédents">
                    <textarea name="previousEvents" id="previousEventsWrite"><?= $dream[0]->previousEvents ?></textarea>
                </label>
            </fieldset>

            <button id="submitDream" class="btn" type="submit" title="Valider">
                <i class="fa fa-check"></i>
            </button>
        </form>

        <div id="btnAction">
            <a href="?p=dreams.read.<?= $dream[0]->id ?>" id="readDream-read" class="btn btnRead" title="Lire">
                <i class="fa fa-file"></i>
            </a>
            <a href="?p=dreams.delete.<?= $dream[0]->id ?>" id="updateDream-delete" class="btn btnDelete"
               title="Supprimer">
                <i class="fa fa-trash"></i>
            </a>

            <?php include_once($this->viewPath . 'dreams/btnPreviousAndNextDream.php'); ?>
        </div>
    </section>

<?php include_once($this->viewPath . 'dreams/search.php'); ?>