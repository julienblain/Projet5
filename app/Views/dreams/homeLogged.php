<section id="homeLogged">
    <p>UTILISATEUR CONNECTÉ</p>
    <button><a href="http://localhost/Projet5/public/index.php?p=app.logout">Déconnexion</a></button>
    <nav id="previousDreams">
        <ul>
            <li><a href="">Reve 1</a></li>
            <li><a href="">Reve 2</a></li>
            <li><a href="">Reve 3</a></li>
        </ul>
    </nav>
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