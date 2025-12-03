<?php

// Assure-toi que $pdo est bien défini avant ce fichier
$promos = $pdo->query("SELECT id, name FROM promo")->fetchAll(PDO::FETCH_ASSOC);
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo     = trim($_POST['pseudo']);
    $name       = trim($_POST['name']);
    $firstname  = trim($_POST['firstname']);
    $email      = trim($_POST['email']);
    $age        = !empty($_POST['age']) ? $_POST['age'] : null; 
    $pwd        = $_POST['pwd'];
    $confirmPwd = $_POST['confirm_pwd'];
    $promoId    = $_POST['promo'] ?? null;

    // regex : Au moins 1 Maj, 1 Chiffre, 1 Spécial, Min 8 caractères
    $regexPwd = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    if (
        empty($pseudo) || empty($name) || empty($firstname) ||
        empty($email) || empty($pwd) || empty($confirmPwd) || empty($promoId)
    ) {
        $message = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
    } elseif ($pwd !== $confirmPwd) { 
        $message = "Les mots de passe ne correspondent pas.";
    } elseif (!preg_match($regexPwd, $pwd)) {
        // MESSAGE MIS À JOUR
        $message = "Le mot de passe doit faire 8 caractères minimum, contenir au moins une majuscule, un chiffre et un caractère spécial.";
    } else {
        try {
            $check = $pdo->prepare("SELECT id FROM user WHERE email = ?");
            $check->execute([$email]);

            if ($check->rowCount() > 0) {
                $message = "Cet email est déjà utilisé.";
            } else {
                $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
                $roleId = 2;

                $insert = $pdo->prepare("
                    INSERT INTO user 
                    (pseudo, name, firstName, email, pwd, age, roles_id, promo_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $insert->execute([
                    $pseudo, $name, $firstname, $email, $hashPwd, $age, $roleId, $promoId
                ]);



                echo "<p style='color:green'>Compte créé avec succès ! Redirection...</p>";
                echo "<script>
                    setTimeout(function(){
                        window.location.href = 'http://localhost:8000/?page=dashboard';
                    }, 1500);
                </script>";
                exit();
            }
        } catch(PDOException $e) {
            $message = "Erreur serveur : " . $e->getMessage();
        }
    }
}
?>
<section class="container-register">
    <div class="logo-register">
        <img src="./assets/images/logo1.jpg" alt="logo de l'association étudiante 'ERROR404' de l'école Need For School Rouen" >
    </div>

    <h2  class="h2-register">Créer un compte</h2>

    <form class="form-register" method="POST">
        <input class="input-register" type="text" name="pseudo" placeholder="Pseudo" value="<?= isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : '' ?>" required>
        <input class="input-register" type="text" name="name" placeholder="Nom" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>
        <input class="input-register" type="text" name="firstname" placeholder="Prénom" value="<?= isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '' ?>" required>
        <input class="input-register" type="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
        <input class="input-register" type="number" name="age" placeholder="Âge (optionnel)" value="<?= isset($_POST['age']) ? htmlspecialchars($_POST['age']) : '' ?>">
        <select class="select-register" name="promo" required>
            <option value="">-- Sélectionnez votre promo --</option>
            <?php foreach ($promos as $promo): ?>
                <option value="<?= $promo['id'] ?>" <?= (isset($_POST['promo']) && $_POST['promo'] == $promo['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($promo['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input class="input-pwd-register" type="password" name="pwd" placeholder="Mot de passe" required>
        
        <small class="form-register small" style="display:block; margin-bottom:10px; color:#666; font-size: 0.8em;">
            Min. 8 caractères, 1 majuscule, 1 chiffre, 1 caractère spécial.
        </small>

        <input class="input-pwd-registerConfirm" type="password" name="confirm_pwd" placeholder="Confirmer le mot de passe" required>

        <button class="register-btn" type="submit">Créer mon compte</button>
    </form>

    <?php if (!empty($message)) echo "<p style='color:red; font-weight:bold;'>$message</p>"; ?>

    <a class="a-register" href="http://localhost:8000/?page=login">Déjà un compte ?</a>
</section>