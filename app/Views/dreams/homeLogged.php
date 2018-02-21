<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
<section id="homeLogged">
    <form action="?p=dreams.created" id="dreamForm" method="post">

        <fieldset id="dream">
            <label for="dreamWrite" aria-label="Écrire votre rêve">
                <span id="label-title">Votre rêve</span>
                <span id="label-arrow">&#x293B;</span>
                <textarea name="dream" id="dreamWrite" required placeholder="Requis"></textarea> <br>
                <!--verifier si le required fonctionne sur safari -->
            </label>
        </fieldset>

        <fieldset id="dateTime">
            <label for="dreamDate" id="dateTime-dreamDate" aria-label="Choisir la date">
                <i class="fa fa-calendar" aria-hidden="true"> </i>
                <input type="date" title="Choisir la date" name="dreamDate" id="dreamDate"
                       value="<?php echo date('Y-m-d'); ?>">
            </label>
            <label for="dreamHour" id="dateTime-dreamHour" aria-label="Choisir l'heure">
                <i class="fa fa-clock-o" aria-hidden="true"> </i>
                <input type="time" id="dreamHour" title="Choisir l'heure" name="dreamHour"
                       value="<?php echo date('H:i'); ?>">
            </label>
        </fieldset>

        <div id="moreElements">
            <p id="elaborationTxt">Élaboration</p>
            <p id="previousEventsTxt">Évènements précédents</p>
        </div>

        <fieldset id="elaboration">
            <label for="elaborationTextarea" aria-label="Écrire une élaboration">
                <textarea name="elaboration" id="elaborationTextarea" title="Écrire une élaboration"> </textarea>
            </label>
        </fieldset>

        <fieldset id="previousEvents">
            <label for="previousEventsWrite" aria-label="Écrire des évnements précédents">
                <textarea name="previousEvents" id="previousEventsWrite"
                          title="Écrire des évnements précédents"> </textarea>
            </label>
        </fieldset>

        <button id="submitDream" class="btn" type="submit" title="Valider">
            <i class="fa fa-check"></i>
        </button>
    </form>
</section>