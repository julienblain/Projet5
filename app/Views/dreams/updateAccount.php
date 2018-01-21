<?php include_once ($this->viewPath .'dreams/nav.php');?>
<section id="updateAccount">
    <h2>Votre profil</h2>

    <form action="?p=user.updatedAccountMail" method="post">
        <h3>Changer d'adresse mail</h3>
        <label for="updateAccountMail-mail">
            Mail :
            <input type="email" id="updateAccountMail-mail" name="mail" placeholder="<?= $_SESSION['mailUser']?>" required>
        </label>
        <label for="updateAccountMail-password">
            Mot de passe :
            <input type="password" id="updateAccountMail-password" name="password" required>
        </label>
        <button id="updateAccountMail" type="submit">Changer</button>
    </form>

    <form action="?p=user.updatedAccountPassword" method="post">
        <h3>Changer de mot de passe</h3>
        <label for="updateAccountOldPassword">
            Mot de passe actuel :
            <input type="password" id="updateAccountOldPassword" name="oldPassword" required>
        </label>
        <label for="updateAccountNewPassword">
            Nouveau mot de passe :
            <input type="password" id="updateAccountNewPassword" name="newPassword" required>
        </label>
        <button id="updateAccountPassword" type="submit">Changer</button>
    </form>

    <form action="?p=user.deletedAccount" method="post">
        <h3>Supprimer le profil</h3>
        <label for="updateAccountDeletedAccount">
            Mot de passe :
            <input type="password" id="updateAccountDeletedAccount" name="password">
        </label>

        <button type="submit" >Supprimer le compte</button>
    </form>



</section>