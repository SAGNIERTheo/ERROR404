<?php

if (isset($_POST)&& !empty($_POST)){
    if (!empty($_POST['oldEmail']) && !empty($_POST['newEmail']) && !empty($_POST['pwd'])){
        $oldEmail = htmlspecialchars(trim($_POST['oldEmail']));
        $newEmail = htmlspecialchars(trim($_POST['newEmail']));
        $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
        $sql = "SELECT * FROM `user` WHERE `email` LIKE '$oldEmail'";
        $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $pwd  = $user['pwd'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id'];
        $id =$_SESSION['id'];
        var_dump($oldEmail===$_SESSION['email']);
        var_dump(password_verify ($pwdVerify, $pwd ));
            if ($oldEmail===$_SESSION['email'] && password_verify ($pwdVerify, $pwd )){
                $modifyEmail = $pdo->prepare("UPDATE `user` SET `Email` = ? WHERE `id` = ?");
                $modifyEmail->execute([$newEmail, $id]);
                var_dump($newEmail);
                $_SESSION ['email'] = $newEmail;
            }
    }
}

?>

<form action="" method="POST">
    <label for="oldEmail">Ancien email :</label><br>
    <input type="text" id="oldEmail" name="oldEmail" required><br><br>

    <label for="newEmail">Nouveau email :</label><br>
    <input type="text" id="newEmail" name="newEmail" required><br><br>

    <label for="pwd">Mot de passe :</label><br>
    <input type="password" id="pwd" name="pwd" required><br><br>

    <button type="submit">Modifier le Email</button>
</form>

