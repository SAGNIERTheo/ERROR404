<?php

$promos = $pdo->query("SELECT id, name FROM promo")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo     = trim($_POST['pseudo']);
    $name       = trim($_POST['name']);
    $firstname  = trim($_POST['firstname']);
    $email      = trim($_POST['email']);
    $age        = !empty($_POST['age']) ? $_POST['age'] : null; 
    $pwd        = $_POST['pwd'];
    $promoId = $_POST['promo'] ?? null;
    if (
        empty($pseudo) || empty($name) || empty($firstname) ||
        empty($email) || empty($pwd) || empty($promoId)
    ) {
        $message = "Veuillez remplir tous les champs obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
    } else {
        try {
            // Vérifier si l'email existe déjà
            $check = $pdo->prepare("SELECT id FROM user WHERE email = ?");
            $check->execute([$email]);

            if ($check->rowCount() > 0) {

                $message = "Cet email est déjà utilisé.";

            } else {

                // HASH DU MOT DE PASSE
                $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

                // Rôle forcé USER = 2
                $roleId = 2;

                $insert = $pdo->prepare("
                    INSERT INTO user 
                    (pseudo, name, firstName, email, pwd, age, roles_id, promo_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $insert->execute([
                    $pseudo,
                    $name,
                    $firstname,
                    $email,
                    $hashPwd,   // ✅ ICI le hash
                    $age,       // ✅ ICI l’âge
                    $roleId,
                    $promoId
                ]);

                echo "<p>Compte créé avec succès ! Redirection...</p>";
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
<section class="container-login">
    <h2>Créer un compte</h2>

    <form method="POST">
        <input type="text" name="pseudo" placeholder="Pseudo" required>
        <input type="text" name="name" placeholder="Nom" required>
        <input type="text" name="firstname" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>

        <input type="number" name="age" placeholder="Âge (optionnel)">

        <!-- ✅ SELECT PROMO DYNAMIQUE -->
        <select name="promo" required>
            <option value="">-- Sélectionnez votre promo --</option>
            <?php foreach ($promos as $promo): ?>
                <option value="<?= $promo['id'] ?>">
                    <?= htmlspecialchars($promo['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="password" name="pwd" placeholder="Mot de passe" required>

        <button type="submit">Créer mon compte</button>
    </form>

    <?php if ($message !== "") echo "<p>$message</p>"; ?>

    <a href="http://localhost:8000/?page=login">Déjà un compte ?</a>
</section>