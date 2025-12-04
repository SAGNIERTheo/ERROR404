<?php
// Inclusion de la navigation (nécessaire pour le style global)
include_once './public/includes/nav.php';

// Sécurité (nécessaire pour accéder à la session)
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

    <h2 class="page-title">Modifier l'email</h2>

    <div class="form-content">
        
        <!-- Zone d'affichage des messages de la logique -->
        <div class="logic-message">
            <?php
            //verifier si formulaire non vide
            if (isset($_POST)&& !empty($_POST)){
                //verifier si tous les champs sont remplie
                if (!empty($_POST['oldEmail']) && !empty($_POST['newEmail']) && !empty($_POST['pwd'])){
                    //securiser contre les injection de code
                    $oldEmail = htmlspecialchars(trim($_POST['oldEmail']));
                    $newEmail = htmlspecialchars(trim($_POST['newEmail']));
                    $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
                    //sortir les infos de la bdd
                    $sql = "SELECT * FROM `user` WHERE `email` LIKE '$oldEmail'";
                    $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                    $id =$_SESSION['id'];
                    $newSql = "SELECT * FROM `user` WHERE `email` = ?";
                    $stmt = $pdo->prepare($newSql);
                    $stmt->execute([$newEmail]);
                    $newUser = $stmt->fetch(PDO::FETCH_ASSOC);
                    //verifier si l'utilisateur connait ses données de connexion
                    if ($oldEmail===$_SESSION['email'] && password_verify ($pwdVerify, $user['pwd'] )) {
                        //verifier si le email est libre
                        if ($newUser === false) {
                            //modifier le email
                            $modifyEmail = $pdo->prepare("UPDATE `user` SET `email` = ? WHERE `id` = ?");
                            $modifyEmail->execute([$newEmail, $id]);
                            $_SESSION ['email'] = $newEmail;
                            //prevenir l'utilisateur
                            echo 'email modifié';

                        }
                        else {
                            echo 'email deja pris';
                        }
                    }
                    else {
                        echo 'mot de passe ou email incorect';
                    }
                }
                else{
                    echo 'veuillez remplir tout les champs';
                }
            }
            else{
                echo 'remplir le formulaire pour modifier votre email';
            }

            ?>
        </div>

        <form action="" method="POST">
            
            <div class="form-group">
                <label for="oldEmail" class="form-label">Ancien email :</label>
                <input type="text" id="oldEmail" name="oldEmail" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="newEmail" class="form-label">Nouveau email :</label>
                <input type="text" id="newEmail" name="newEmail" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="pwd" class="form-label">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" class="form-input" required>
            </div>

            <button type="submit" class="btn-submit">Modifier le email</button>
        </form>
    </div>

</section>