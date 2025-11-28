<?php
//verifier si formulaire non vide
if (isset($_POST)&& !empty($_POST)){
    //verifier si tous les champs sont remplie
    if (!empty($_POST['oldName']) && !empty($_POST['newName']) && !empty($_POST['pwd'])){
        //securiser contre les injection de code
        $oldName = htmlspecialchars(trim($_POST['oldName']));
        $newName = htmlspecialchars(trim($_POST['newName']));
        $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
        //sortir les infos de la bdd
        $sql = "SELECT * FROM `user` WHERE `name` LIKE '$oldName'";
        $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $id =$_SESSION['id'];
        //verifier si l'utilisateur connait ses données de connexion
        if ($oldName===$_SESSION['name'] && password_verify ($pwdVerify, $user['pwd'] )) {
                //modifier le name
                $modifyName = $pdo->prepare("UPDATE `user` SET `name` = ? WHERE `id` = ?");
                $modifyName->execute([$newName, $id]);
                $_SESSION ['name'] = $newName;
                //prevenir l'utilisateur
                echo 'nom de famille modifié';

        }
        else {
            echo 'mot de passe ou nom de famille incorect';
        }
    }
    else{
        echo 'veuillez remplir tout les champs';
    }
}
else{
    echo 'remplir le formulaire pour changer de nom de famille';
}

?>

<form action="" method="POST">
    <label for="oldName">Ancien nom de famille :</label><br>
    <input type="text" id="oldName" name="oldName" required><br><br>

    <label for="newName">Nouveau nom de famille :</label><br>
    <input type="text" id="newName" name="newName" required><br><br>

    <label for="pwd">Mot de passe :</label><br>
    <input type="password" id="pwd" name="pwd" required><br><br>

    <button type="submit">Modifier le nom de famille</button>
</form>
