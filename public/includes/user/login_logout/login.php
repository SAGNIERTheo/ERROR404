<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userEmail = trim($_POST['userEmail']);
    $userPwd = $_POST['userPwd'];

    if (empty($userEmail) || empty($userPwd)) {
        $message = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
    } else {
        try {
            // Récupérer l'utilisateur par email
            $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$userEmail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt2 = $pdo->prepare("SELECT * FROM roles WHERE id = ?");
            $stmt2->execute([$user['roles_id']]);
            $roles = $stmt2 -> fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($userPwd, $user['pwd'])) {

                // Connexion réussie, création des sessions
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['age'] = $user['age'];
                $_SESSION['roles'] = $roles['name'];
                $_SESSION['promo_id'] = $user['promo_id'];

                echo "<p>Connexion réussie ! Redirection en cours...</p>";
                echo "<script>
                    setTimeout(function(){
                        window.location.href = '?page=dashboard';
                    }, 1500);
                </script>";
                exit();

            } else {
                $message = "Email ou mot de passe incorrect.";
            }

        } catch(PDOException $e) {
            $message = "Erreur serveur : " . $e->getMessage();
        }
    }
}
?>


<section class="container-login">
    <div class="logo-login">
        <img src="./assets/images/logo1.jpg" alt="logo de l'association étudiante 'ERROR404' de l'école Need For School Rouen" >
    </div>

    <form action="#" method="POST" >
        <h2>Connexion</h2>
        <input class="input-login" type="email" name="userEmail" placeholder="Votre email" required value="<?= htmlspecialchars($_POST['userEmail'] ?? '') ?>">
        <input class="input-login" type="password" name="userPwd" placeholder="Votre mot de passe" required>
        <button class="form-btn-login" type="submit">Se connecter</button>
    </form>

    <a href="http://localhost:8000/?page=register">
        <button class="register-btn">Créer mon compte</button>
    </a>

    <a href="http://localhost:8000/?page=pwdForget">
        <p class="pwd-user-btn">Mot de passe oublié ?</p>
    </a>

    <?php if ($message !== "") { echo "<p>$message</p>"; }?>

</section>