<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="homeLogged">
    <form action="?p=dreams.created" id="dreamForm" method="post">

        <fieldset id="dream">
            <label  for="dream">
                <p>Votre rêve
                    <span>&#x293B;</span></p>
                <textarea name="dream" id="dreamWrite" required placeholder="Requis"></textarea> <br> <!--verifier si le required fonctionne sur safari -->
            </label>
        </fieldset>

            <?php
            //TODO penser que la date risque de bugger sur safari et ie
            ?>
        <fieldset id="dateTime">
            <label for="dreamDate" id="dateTime-dreamDate">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                 <input type="date" name="dreamDate" id="dreamDate" value="<?php echo date('Y-m-d'); ?>" >
            </label>
            <label for="dreamHour" id="dateTime-dreamHour">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <input type="time" id="dreamHour" name="dreamHour" value="<?php echo date('H:i');?>">
            </label>
        </fieldset>



        <div id="moreElements">
            <p id="elaborationTxt">Élaboration</p>
            <p id="previousEventsTxt">Évènements précédents</p>
        </div>
            <fieldset id="elaboration">
                <label for="elaboration">

                    <textarea name="elaboration" id="elaborationTextarea"></textarea>
                </label>
            </fieldset>

            <fieldset id="previousEvents">

                <label for="previousEvents">

                    <textarea name="previousEvents" id="previousEventsWrite"></textarea>
                </label>
            </fieldset>
        <button id="submitDream" class="btn" type="submit"><i class="fa fa-check"></i></button>
    </form>
</section>