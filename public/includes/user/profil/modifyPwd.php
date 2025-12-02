<?php
if (!empty($_POST)) {
    if (!empty($_POST['oldPwd']) && !empty($_POST['newPwd']) && !empty($_POST['pseudo'])) {
        $oldPwd = trim($_POST['oldPwd']);
        $newPwd = trim($_POST['newPwd']);
        $pseudoVerify = trim($_POST['pseudo']);
        $regexPwd = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        // Récupérer l'utilisateur via son pseudo
        $sql = "SELECT * FROM `user` WHERE `pseudo` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pseudoVerify]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            echo "Utilisateur introuvable";
            exit;
        }
        $id = $user['id'];
        // Vérifier que le pseudo est correct ET que l'ancien mot de passe est bon
        if ($pseudoVerify === $_SESSION['pseudo'] && password_verify($oldPwd, $user['pwd'])) {
            // Vérifier format du nouveau mot de passe
            if (preg_match($regexPwd, $newPwd)) {
                // Hash du nouveau mot de passe
                $newHash = password_hash($newPwd, PASSWORD_DEFAULT);
                // Update sécurisé
                $modifyPwd = $pdo->prepare("UPDATE `user` SET `pwd` = ? WHERE `id` = ?");
                $modifyPwd->execute([$newHash, $id]);
                echo "Mot de passe modifié avec succès";
            } else {
                echo "Le mot de passe doit faire au moins 8 caractères, contenir une majuscule, un chiffre et un caractère spécial.";
            }
        } else {
            echo "Mot de passe ou pseudo incorrect.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Remplir le formulaire pour changer de mot de passe.";
}
?>


<form action="" method="POST">
    <label for="oldPwd">Ancien mot de passe :</label><br>
    <input type="password" id="oldPwd" name="oldPwd" required><br><br>

    <label for="newPwd">Nouveau mot de passe :</label><br>
    <input type="password" id="newPwd" name="newPwd" required><br><br>

    <label for="pseudo">pseudo :</label><br>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <button type="submit">Modifier le mot de passe</button>
</form>
