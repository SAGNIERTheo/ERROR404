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
            $stmt = $pdo->prepare("SELECT * FROM user WHERE userEmail = ?");
            $stmt->execute([$userEmail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($userPwd, $user['userPwd'])) {
                // Connexion réussie, création des sessions
                $_SESSION['iduser'] = $user['iduser'];
                $_SESSION['userName'] = $user['userName'];
                $_SESSION['userSurname'] = $user['userSurname'];
                $_SESSION['userEmail'] = $user['userEmail'];
                $_SESSION['role_iduserRole'] = $user['role_iduserRole'];

                // Message de succès et redirection après 1.5 sec
                echo "<p>Connexion réussie ! Redirection en cours...</p>";
                echo "<script>
                    setTimeout(function(){
                        window.location.href = 'layout.php';
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
        <img src="/assets/images/Logo.png" alt="logo de la web app 'Garant'IA'" >
    </div>
    <div id="register-title">
        <p>Le Dashboard de garanties qui ne vous fera pas oublier votre argent.</p>
    </div>

    <form action="#" method="POST">
        <h2>Connexion</h2>
        <input type="email" name="userEmail" placeholder="Votre email" required value="<?= htmlspecialchars($_POST['userEmail'] ?? '') ?>">
        <input type="password" name="userPwd" placeholder="Votre mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>

    <a href="http://localhost:8000/?page=register">
        <button class="register-btn">Créer mon compte</button>
    </a>

    <a href="http://localhost:8000/?page=pwdForget">
        <p class="pwd-user-btn">Mot de passe oublié ?</p>
    </a>

    <?php if ($message !== "") { echo "<p>$message</p>"; }?>

</section>