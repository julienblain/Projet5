<header>
    <a href="http://localhost/Projet5/public/index.php?p=user.homeLogged" id="logo" title="Retourner à l'accueil">
        <img id="logo-img" src="http://localhost/Projet5/public/img/logo.jpg" alt="logo du site BLA-BLA">
    </a>

    <nav>
        <button title="Connexion" id="nav-login">
            <i class="fa icon-enter"></i>
        </button>
    </nav>
</header>

<div id="home-login">
    <form action="?p=user.control" id="home-login-form" method="post">
        <label for="home-login-form-mail">
            Mail :
            <input id="home-login-form-mail" type="email" name="mail" required>
        </label>

        <label for="home-login-form-password">
            Mot de passe :
            <input id="home-login-form-password" type="password" name="password" required>
        </label>
        <div class="g-recaptcha" data-sitekey="6LfLBkEUAAAAAD3qRe3tWGwihN5ItNVk3gCeju7r"></div>
        <button id="home-login-form-btn" class="btn" name="home-login-form-btn" type="submit" title="Se connecter">
            <i class="fa icon-checkmark"></i>
        </button>
        <p id="home-login-forgetPass">Mot de passe oublié ?</p>
    </form>

    <div id="forgetPassBox">

        <form action="?p=user.forgetPass" id="home-login-forgetPass-form" method="post">
            <label for="home-login-forgetPass-mail">
                Mail :
                <input id="home-login-forgetPass-mail" type="email" name="mail" required>
            </label>
            <div class="g-recaptcha" data-sitekey="6LfLBkEUAAAAAD3qRe3tWGwihN5ItNVk3gCeju7r"></div>
            <button id="home-login-forgetPass-btn" class="btn" type="submit" name="home-login-forgetPass-btn" title="Envoyer">
                <i class="fa icon-checkmark"></i>
            </button>
        </form>
    </div>
</div>

<section id="home">
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
            <div class="g-recaptcha" data-sitekey="6LfLBkEUAAAAAD3qRe3tWGwihN5ItNVk3gCeju7r"></div>
            <button id="home-createAccount-form-btn" type="submit" name="home-createAccount-form-btn">Envoyer</button>
        </form>
    </div>
</section>
