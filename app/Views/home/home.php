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
            Mail :<br>
            <input id="home-login-form-mail" type="email" name="mail" required>
        </label>

        <label for="home-login-form-password">
            Mot de passe : <br>
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
                Mail : <br>
                <input id="home-login-forgetPass-mail" type="email" name="mail" required>
            </label>
            <div class="g-recaptcha" data-sitekey="6LfLBkEUAAAAAD3qRe3tWGwihN5ItNVk3gCeju7r"></div>
            <button id="home-login-forgetPass-btn" class="btn" type="submit" name="home-login-forgetPass-btn" title="Envoyer">
                <i class="fa icon-checkmark"></i>
            </button>
            <p class="opacity">Un lien de votre compte vous sera envoyé par mail.</p>
        </form>
    </div>
</div>

<section id="home">
    <div id="home-homeLogged">
        <h2>Journal</h2>
        <div id="home-homeLogged-box" class="box">
            <div id="home-homeLogged-txt" class="txt">
                <p id="slogan">Avec <em>BLA-BLA</em>, enregistrez tous vos rêves, rêveries diurnes et élaborations.</p>
                <span id="home-homeLogged-right" class="spe-arrow spe-right">&#x293B;</span>
                <p id="home-homeLogged-register">Inscrivez-vous !</p>
                <span id="home-homeLogged-down" class="spe-arrow spe-down">&#x2935;</span>
            </div>
            <img id="home-homeLogged-img" src="img/home/homelogged.png"
                 alt="Accueil une fois connecté d'enregistrement du rêve.">
        </div>
    </div>
    <div id="home-createAccount">
        <h2>S'inscrire</h2>
        <form action="?p=user.createAccount" id="home-createAccount-form" method="post" class="box">
            <label for="home-createAccount-form-mail">
                Mail : <br>
                <input id="home-createAccount-form-mail" type="email" name="mail" required>
            </label>

            <label for="home-createAccount-form-password">
                Mot de passe : <br>
                <input id="home-createAccount-form-password" type="password" name="password" required>
            </label>

            <div class="g-recaptcha" data-sitekey="6LfLBkEUAAAAAD3qRe3tWGwihN5ItNVk3gCeju7r"></div>

            <p id="home-createAccount-form-p" class="opacity">Un lien de validation de votre compte vous sera envoyé par
                mail.</p>
            <button id="home-createAccount-form-btn" type="submit" name="home-createAccount-form-btn" class="btn"
                    title="S'inscrire">
                <i class="fa icon-checkmark"></i>
            </button>
        </form>
    </div>

    <div id="home-index">
        <h2>Index</h2>
        <div class="box">
            <div id="home-index-txt" class="txt">
                <p>Vous pouvez consulter vos rêves à partir de votre index.</p>
            </div>
            <img src="img/home/index.png" alt="Capture d'écran de l'index des rêves" id="home-index-img">
        </div>
    </div>

    <div id="home-search">
        <h2>Recherche</h2>
        <div class="box">
            <div id="home-search-txt" class="txt">
                <p>Et trouver des mots qui se répètent.</p>
            </div>
            <img src="img/home/search.png" alt="Capture d'écran des résultats de recherche.">
        </div>
    </div>
</section>
