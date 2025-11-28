<?php
//verifier si formulaire non vide
if (isset($_POST)&& !empty($_POST)){
    //verifier si tous les champs sont remplie
    if (!empty($_POST['oldPseudo']) && !empty($_POST['newPseudo']) && !empty($_POST['pwd'])){
        //securiser contre les injection de code
        $oldPseudo = htmlspecialchars(trim($_POST['oldPseudo']));
        $newPseudo = htmlspecialchars(trim($_POST['newPseudo']));
        $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
        //sortir les infos de la bdd
        $sql = "SELECT * FROM `user` WHERE `pseudo` LIKE '$oldPseudo'";
        $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $id =$_SESSION['id'];
        $newSql = "SELECT * FROM `user` WHERE `pseudo` = ?";
        $stmt = $pdo->prepare($newSql);
        $stmt->execute([$newPseudo]);
        $newUser = $stmt->fetch(PDO::FETCH_ASSOC);
        //verifier si l'utilisateur connait ses données de connexion
        if ($oldPseudo===$_SESSION['pseudo'] && password_verify ($pwdVerify, $user['pwd'] )) {
            //verifier si le pseudo est libre
            if ($newUser === false) {
                //modifier le pseudo
                $modifyPseudo = $pdo->prepare("UPDATE `user` SET `pseudo` = ? WHERE `id` = ?");
                $modifyPseudo->execute([$newPseudo, $id]);
                $_SESSION ['pseudo'] = $newPseudo;
                //prevenir l'utilisateur
                echo 'pseudo modifié';

            }
            else {
                echo 'pseudo deja pris';
            }
        }
        else {
            echo 'mot de passe ou pseudo incorect';
        }
    }
    else{
        echo 'veuillez remplir tout les champs';
    }
}
else{
    echo 'remplir le formulaire pour changer de pseudo';
}

?>

<form action="" method="POST">
    <label for="oldPseudo">Ancien pseudo :</label><br>
    <input type="text" id="oldPseudo" name="oldPseudo" required><br><br>

    <label for="newPseudo">Nouveau pseudo :</label><br>
    <input type="text" id="newPseudo" name="newPseudo" required><br><br>

    <label for="pwd">Mot de passe :</label><br>
    <input type="password" id="pwd" name="pwd" required><br><br>

    <button type="submit">Modifier le pseudo</button>
</form>
