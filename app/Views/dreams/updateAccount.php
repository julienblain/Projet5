<?php include_once($this->viewPath . 'dreams/nav.php'); ?>
<section id="updateAccount">
    <h1>Votre profil</h1>
    <form action="?p=user.updatedAccountMail" method="post">
        <h2>Changer d'adresse mail</h2>
        <label for="updateAccountMail-mail">
            Mail :
            <input type="email" id="updateAccountMail-mail" name="mail" placeholder="<?= $_SESSION['mailUser'] ?>"
                   required>
        </label>
        <label for="updateAccountMail-password">
            Mot de passe :
            <input type="password" id="updateAccountMail-password" name="password" required>
        </label>
        <button id="updateAccountMail" class="btn" type="submit" title="Modifier">
            <i class="fa icon-checkmark"></i>
        </button>
    </form>

    <form action="?p=user.updatedAccountPassword" method="post">
        <h2>Changer de mot de passe</h2>
        <label for="updateAccountOldPassword">
            Mot de passe actuel :
            <input type="password" id="updateAccountOldPassword" name="oldPassword" required>
        </label>
        <label for="updateAccountNewPassword">
            Nouveau mot de passe :
            <input type="password" id="updateAccountNewPassword" name="newPassword" required>
        </label>
        <button id="updateAccountPassword" class="btn" type="submit" title="Modifier">
            <i class="fa icon-checkmark"></i>
        </button>
    </form>

    <form action="?p=user.deletedAccount" method="post">
        <h2>Supprimer le profil</h2>
        <label for="updateAccountDeletedAccount" id="deleteAccountLabel">
            Mot de passe :
            <input type="password" id="updateAccountDeletedAccount" name="password">
        </label>
        <button type="submit" id="deleteAccount" class="btn btnDelete" title="Supprimer">
            <i class="fa icon-bin2"></i>
        </button>
    </form>
</section>