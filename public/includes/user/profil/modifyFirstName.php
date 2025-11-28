<?php
//verifier si formulaire non vide
if (isset($_POST)&& !empty($_POST)){
    //verifier si tous les champs sont remplie
    if (!empty($_POST['oldFirstName']) && !empty($_POST['newFirstName']) && !empty($_POST['pwd'])){
        //securiser contre les injection de code
        $oldFirstName = htmlspecialchars(trim($_POST['oldFirstName']));
        $newFirstName = htmlspecialchars(trim($_POST['newFirstName']));
        $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
        //sortir les infos de la bdd
        $sql = "SELECT * FROM `user` WHERE `firstName` LIKE '$oldFirstName'";
        $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $id =$_SESSION['id'];
        //verifier si l'utilisateur connait ses données de connexion
        if ($oldFirstName===$_SESSION['firstName'] && password_verify ($pwdVerify, $user['pwd'] )) {
            //modifier le firstName
            $modifyFirstName = $pdo->prepare("UPDATE `user` SET `firstName` = ? WHERE `id` = ?");
            $modifyFirstName->execute([$newFirstName, $id]);
            $_SESSION ['firstName'] = $newFirstName;
            //prevenir l'utilisateur
            echo 'prénom modifié';

        }
        else {
            echo 'mot de passe ou prénom incorect';
        }
    }
    else{
        echo 'veuillez remplir tout les champs';
    }
}
else{
    echo 'remplir le formulaire pour changer de prénom';
}

?>

<form action="" method="POST">
    <label for="oldFirstName">Ancien prénom :</label><br>
    <input type="text" id="oldFirstName" name="oldFirstName" required><br><br>

    <label for="newFirstName">Nouveau prénom :</label><br>
    <input type="text" id="newFirstName" name="newFirstName" required><br><br>

    <label for="pwd">Mot de passe :</label><br>
    <input type="password" id="pwd" name="pwd" required><br><br>

    <button type="submit">Modifier le prénom</button>
</form>
