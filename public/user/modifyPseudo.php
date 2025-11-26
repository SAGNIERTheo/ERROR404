<?php
if (isset($_POST)&& !empty($_POST)){
    if (!empty($_POST['oldPseudo']) && !empty($_POST['newPseudo']) && !empty($_POST['pwd']));{
        $oldPseudo = htmlspecialchars(trim($_POST['oldPseudo']));
        $newPseudo = htmlspecialchars(trim($_POST['newPseudo']));
        $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
        $sql = "SELECT * FROM `user` WHERE `pseudo` LIKE '$pseudo'";
        $user = $pdo->query($sql)->fetchAll();
        $pwd = $user[5];
            if ($oldPseudo===$_SESSION['pseudo'] && password_verify ('$pwdVerify', '$pwd' )){

        }
    }
}