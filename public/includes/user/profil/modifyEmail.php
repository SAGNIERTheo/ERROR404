<?php
//verifier si formulaire non vide
if (isset($_POST)&& !empty($_POST)){
    //verifier si tous les champs sont remplie
    if (!empty($_POST['oldEmail']) && !empty($_POST['newEmail']) && !empty($_POST['pwd'])){
        //securiser contre les injection de code
        $oldEmail = htmlspecialchars(trim($_POST['oldEmail']));
        $newEmail = htmlspecialchars(trim($_POST['newEmail']));
        $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
        //sortir les infos de la bdd
        $sql = "SELECT * FROM `user` WHERE `email` LIKE '$oldEmail'";
        $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $id =$_SESSION['id'];
        $newSql = "SELECT * FROM `user` WHERE `email` = ?";
        $stmt = $pdo->prepare($newSql);
        $stmt->execute([$newEmail]);
        $newUser = $stmt->fetch(PDO::FETCH_ASSOC);
        //verifier si l'utilisateur connait ses données de connexion
        if ($oldEmail===$_SESSION['email'] && password_verify ($pwdVerify, $user['pwd'] )) {
            //verifier si le email est libre
            if ($newUser === false) {
                //modifier le email
                $modifyEmail = $pdo->prepare("UPDATE `user` SET `email` = ? WHERE `id` = ?");
                $modifyEmail->execute([$newEmail, $id]);
                $_SESSION ['email'] = $newEmail;
                //prevenir l'utilisateur
                echo 'email modifié';

            }
            else {
                echo 'email deja pris';
            }
        }
        else {
            echo 'mot de passe ou email incorect';
        }
    }
    else{
        echo 'veuillez remplir tout les champs';
    }
}
else{
    echo 'remplir le formulaire pour changer de email';
}

?>

<form action="" method="POST">
    <label for="oldEmail">Ancien email :</label><br>
    <input type="text" id="oldEmail" name="oldEmail" required><br><br>

    <label for="newEmail">Nouveau email :</label><br>
    <input type="text" id="newEmail" name="newEmail" required><br><br>

    <label for="pwd">Mot de passe :</label><br>
    <input type="password" id="pwd" name="pwd" required><br><br>

    <button type="submit">Modifier le email</button>
</form>
