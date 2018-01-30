<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="homeLogged">
    <form action="?p=dreams.created" id="dreamForm" method="post">
        <fieldset id="dream">
            <legend>Rêve</legend>
            <label for="dream">
                <textarea name="dream" id="dreamWrite" cols="30" rows="10" required placeholder="Requis"></textarea> <br> <!--verifier si le required fonctionne sur safari -->
            </label>


            <?php
            //TODO penser que la date risque de bugger sur safari et ie
            ?>
            <label for="dreamDate"> Date :
                 <input type="date" name="dreamDate" id="dreamDate" value="<?php echo date('Y-m-d'); ?>" >
            </label>
            <label for="dreamHour"> Heure :
                <input type="time" id="dreamHour" name="dreamHour" value="<?php echo date('H:i');?>">
            </label>
        </fieldset>



        <fieldset id="elaboration">
            <legend>Élaboration</legend>
            <label for="elaboration">
                <textarea name="elaboration" id="elaborationTextarea" cols="30" rows="10"></textarea> <br>
            </label>
        </fieldset>

        <fieldset id="previousEvents">
            <legend>Évènements précédents</legend>
            <label for="previousEvents">
                <textarea name="previousEvents" id="previousEventsWrite" cols="30" rows="10"></textarea> <br>
            </label>
        </fieldset>

        <button id="submitDream" type="submit">Valider</button>
    </form>
</section>