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

    <h2 class="page-title">Modifier le pseudo</h2>

    <div class="form-content">
        
        <!-- Zone d'affichage des messages de la logique -->
        <div class="logic-message">
            <?php
            // --- LOGIQUE D'ORIGINE ---
            //verifier si formulaire non vide
            if (isset($_POST)&& !empty($_POST)){
                //verifier si tous les champs sont remplie
                if (!empty($_POST['oldPseudo']) && !empty($_POST['newPseudo']) && !empty($_POST['pwd'])){
                    //securiser contre les injection de code
                    $oldPseudo = htmlspecialchars(trim($_POST['oldPseudo']));
                    $newPseudo = htmlspecialchars(trim($_POST['newPseudo']));
                    $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
                    //sortir les infos de la bdd
                    $sql = "SELECT * FROM `user` WHERE `pseudo` LIKE '$oldPseudo'";
                    $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                    $id =$_SESSION['id'];
                    $newSql = "SELECT * FROM `user` WHERE `pseudo` = ?";
                    $stmt = $pdo->prepare($newSql);
                    $stmt->execute([$newPseudo]);
                    $newUser = $stmt->fetch(PDO::FETCH_ASSOC);
                    //verifier si l'utilisateur connait ses données de connexion
                    if ($oldPseudo===$_SESSION['pseudo'] && password_verify ($pwdVerify, $user['pwd'] )) {
                        //verifier si le pseudo est libre
                        if ($newUser === false) {
                            //modifier le pseudo
                            $modifyPseudo = $pdo->prepare("UPDATE `user` SET `pseudo` = ? WHERE `id` = ?");
                            $modifyPseudo->execute([$newPseudo, $id]);
                            $_SESSION ['pseudo'] = $newPseudo;
                            //prevenir l'utilisateur
                            echo 'pseudo modifié';

                        }
                        else {
                            echo 'pseudo deja pris';
                        }
                    }
                    else {
                        echo 'mot de passe ou pseudo incorect';
                    }
                }
                else{
                    echo 'veuillez remplir tout les champs';
                }
            }
            else{
                echo 'remplir le formulaire pour changer de pseudo';
            }
            // --- FIN LOGIQUE D'ORIGINE ---
            ?>
        </div>

        <form action="" method="POST">
            
            <div class="form-group">
                <label for="oldPseudo" class="form-label">Ancien pseudo :</label>
                <input type="text" id="oldPseudo" name="oldPseudo" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="newPseudo" class="form-label">Nouveau pseudo :</label>
                <input type="text" id="newPseudo" name="newPseudo" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="pwd" class="form-label">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" class="form-input" required>
            </div>

            <button type="submit" class="btn-submit">Modifier le pseudo</button>
        </form>
    </div>

    <div class="bottom-spacer"></div>

</section>