<section id="home">
    <div id="home-login">
        <h2>Bonjour, veuillez vous identifier.</h2>
        <form action="?p=user.control" id="home-login-form" method="post">
            <label for="home-login-form-login">
                Login :
                <input id="home-login-form-login" type="text" name="login" required>
            </label>

            <label for="home-login-form-password">
                Mot de passe :
                <input id="home-login-form-password" type="password" name="password" required>
            </label>

            <button id="home-login-form-btn" type="submit" name="home-login-form-btn">Valider</button>
        </form>
    </div>

</section>