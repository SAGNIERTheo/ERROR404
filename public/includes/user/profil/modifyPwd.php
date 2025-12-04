<?php
// Inclusion de la navigation
include_once './public/includes/nav.php';

// Sécurité
if (!isset($_SESSION['id'])) {
    header('Location: ?page=login');
    exit;
}
?>

<section class="app-container">

    <!-- Header Navigation -->
    <div class="header-nav">
        <a href="?page=modifyProfil" class="link-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            Retour
        </a>
    </div>

    <h2 class="page-title">Modifier le mot de passe</h2>

    <div class="form-content">
        
        <!-- Zone d'affichage des messages de la logique -->
        <div class="logic-message">
            <?php
            // --- LOGIQUE D'ORIGINE ---
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
            // --- FIN LOGIQUE D'ORIGINE ---
            ?>
        </div>

        <form action="" method="POST">
            
            <div class="form-group">
                <label for="oldPwd" class="form-label">Ancien mot de passe :</label>
                <input type="password" id="oldPwd" name="oldPwd" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="newPwd" class="form-label">Nouveau mot de passe :</label>
                <input type="password" id="newPwd" name="newPwd" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="pseudo" class="form-label">Confirmer votre pseudo :</label>
                <input type="text" id="pseudo" name="pseudo" class="form-input" required>
            </div>

            <button type="submit" class="btn-submit">Modifier le mot de passe</button>
        </form>
    </div>

    <div class="bottom-spacer"></div>

</section>