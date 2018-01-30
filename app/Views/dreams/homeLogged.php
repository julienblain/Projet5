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
            <fieldset id="elaboration">
                <label for="elaboration">
                    <p>Élaboration</p>
                    <textarea name="elaboration" id="elaborationTextarea" cols="30" rows="10"></textarea> <br>
                </label>
            </fieldset>

            <fieldset id="previousEvents">

                <label for="previousEvents">
                    <p>Évènements précédents</p>
                    <textarea name="previousEvents" id="previousEventsWrite" cols="30" rows="10"></textarea> <br>
                </label>
            </fieldset>
        </div>
        <input id="submitDream" class="normalizeDesign btn" type="submit" value="Valider">
    </form>
</section>