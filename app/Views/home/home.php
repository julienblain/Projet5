<section id="home">
    <div id="home-login">
        <h2>Déjà inscrit :</h2>
        <form action="?p=user.control" id="home-login-form" method="post">
            <label for="home-login-form-mail">
                Mail :
                <input id="home-login-form-mail" type="email" name="mail" required>
            </label>

            <label for="home-login-form-password">
                Mot de passe :
                <input id="home-login-form-password" type="password" name="password" required>
            </label>

            <button id="home-login-form-btn" type="submit" name="home-login-form-btn">Valider</button>
        </form>
    </div>
    <div id="home-createAccount">
        <h2>S'inscrire :</h2>
        <form action="?p=user.createAccount" id="home-createAccount-form" method="post">
            <label for="home-createAccount-form-mail">
                Mail :
                <input id="home-createAccount-form-mail" type="email" name="mail" required>
            </label>

            <label for="home-createAccount-form-password">
                Mot de passe :
                <input id="home-createAccount-form-password" type="password" name="password" required>
            </label>

            <p id="home-createAccount-form-p">Un lien de validation de votre compte vous sera envoyé par mail.</p>
            <button id="home-createAccount-form-btn" type="submit" name="home-createAccount-form-btn">Envoyer</button>
        </form>
    </div>
</section>
<?= phpinfo() ?>