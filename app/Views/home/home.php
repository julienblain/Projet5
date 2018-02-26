<header>
    <nav>
        <a href="http://localhost/Projet5/public/index.php?p=user.homeLogged" id="logo" title="Retourner à l'accueil">
            <h1>
                <img id="logo-img" src="http://localhost/Projet5/public/img/logo1.png" alt="logo du site BLA-BLA">
            </h1>
        </a>
        <div id="nav-btn-box">
            <button title="Inscription" id="nav-register">
                <i class="fa icon-clipboard"></i>
            </button>
            <button title="Connexion" id="nav-login">
                <i class="fa icon-key"></i>
            </button>
        </div>
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
            <button id="home-login-forgetPass-btn" class="btn" type="submit" name="home-login-forgetPass-btn"
                    title="Envoyer">
                <i class="fa icon-checkmark"></i>
            </button>
            <p class="opacity">Un lien de votre compte vous sera envoyé par mail.</p>
        </form>
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

        <button id="home-createAccount-form-btn" type="submit" name="home-createAccount-form-btn" class="btn"
                title="S'inscrire">
            <i class="fa icon-checkmark"></i>
        </button>
        <p id="home-createAccount-form-p" class="opacity">Un lien de validation de votre compte vous sera envoyé par
            mail.</p>
    </form>
</div>
<section id="home">
    <div id="home-homeLogged">
        <h2>Journal</h2>
        <div id="home-homeLogged-box" class="box">
            <div id="home-homeLogged-txt" class="txt">
                <p id="slogan">Avec <em>BLA-BLA</em>, enregistrez tous vos rêves, rêveries diurnes et élaborations.</p>
                <span id="home-homeLogged-right" class="spe-arrow spe-right">&#x293B;</span>

                <button title="Inscription" id="home-register" class="btn btn-register">
                    Inscrivez-vous !
                </button>

            </div>
            <img id="home-homeLogged-img" src="img/home/homelogged.png"
                 alt="Accueil une fois connecté d'enregistrement du rêve.">
        </div>
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

    <div id="home-question">
        <h2>Questions</h2>
        <div class="box">
            <p class="question">Pourquoi noter ses rêves ?</p>
            <p class="answer">Si vous croyez que vos rêves peuvent avoir du sens, et une valeur introspective,
                alors les noter permet de ne pas les oublier.</p>
            <br>
            <p class="question">Qu'est-ce que l'élaboration ?</p>
            <p class="answer">C'est le processus psychique ici qui consiste à associer librement des idées, à faire des
                liens, à penser son rêve pour en tirer du sens ou pas.
                C'est l'espace du bla-bla, où vous noterez les 'ça me fait penser à ça', 'ça me rappelle ci'...
            </p>
            <br>
            <p class="question">Pourquoi noter les évènements précédents ?</p>
            <p class="answer">D'après la théorie psychanalytique, qui n'est pas une science rappelons le, les rêves
                sont directement en lien avec nos pensées conscientes ou inconscientes de la veille.</p>
            <br>
            <p class="question">Pourquoi rechercher des mots ?</p>
            <p class="answer">La fonction de recherche peut-être intéressante car certains mots, et plus justement
                certains sons
                ont une valeur de symbole singulier, et se répètent dans notre vie psychique. Ils sont un agrégat de
                sens sur notre rapport au monde.
            </p>
            <br>
            <p class="question">Comment sont hiérarchisés les résultats d'une recherche ?</p>
            <p class="answer">La recherche se base sur un découpage du mot en 3, 4 et 5 lettres.
                Plus ce segment de mot (son) se répète dans votre indexation, plus le résultat sera placé en tête.
            </p>


        </div>
    </div>
</section>
