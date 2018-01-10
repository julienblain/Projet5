<?php include_once ($this->viewPath. 'dreams/nav.php');?>
<section id="homeLogged">
    <form action="?p=dreams.submit" id="dreamForm" method="post">
        <article id="dream">
            <label for="dreamWrite"> Rêve :</label>
            <textarea name="dreamWrite" id="dreamWrite" cols="30" rows="10" required placeholder="Requis"></textarea> <br> <!--verifier si le required fonctionne sur safari -->

            <label for="dreamDate"></label> Date :
            <input type="date" name="dreamDate" id="dreamDate">

            <label for="dreamHour"> Heure :</label>
            <input type="time" id="dreamHour" name="dreamHour">
        </article>

        <aside id="previousEvents">
            <label for="previousEventsWrite"> Evenements précédents :</label>
            <textarea name="previousEventsWrite" id="previousEventsWrite" cols="30" rows="10"></textarea> <br>
        </aside>

        <aside id="elaboration">
            <label for="elaborationWrite"> Elaboration :</label>
            <textarea name="elaborationWrite" id="elaborationTextarea" cols="30" rows="10"></textarea> <br>
        </aside>
        <button id="submitDream" type="submit">Valider</button>
    </form>
</section>