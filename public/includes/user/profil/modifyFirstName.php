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

    <h2 class="page-title">Modifier le prénom</h2>

    <div class="form-content">
        
        <!-- Zone d'affichage des messages de la logique -->
        <div class="logic-message">
            <?php
            // --- LOGIQUE D'ORIGINE ---
            //verifier si formulaire non vide
            if (isset($_POST)&& !empty($_POST)){
                //verifier si tous les champs sont remplie
                if (!empty($_POST['oldFirstName']) && !empty($_POST['newFirstName']) && !empty($_POST['pwd'])){
                    //securiser contre les injection de code
                    $oldFirstName = htmlspecialchars(trim($_POST['oldFirstName']));
                    $newFirstName = htmlspecialchars(trim($_POST['newFirstName']));
                    $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
                    //sortir les infos de la bdd
                    $sql = "SELECT * FROM `user` WHERE `firstName` LIKE '$oldFirstName'";
                    $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                    $id =$_SESSION['id'];
                    //verifier si l'utilisateur connait ses données de connexion
                    if ($oldFirstName===$_SESSION['firstName'] && password_verify ($pwdVerify, $user['pwd'] )) {
                        //modifier le firstName
                        $modifyFirstName = $pdo->prepare("UPDATE `user` SET `firstName` = ? WHERE `id` = ?");
                        $modifyFirstName->execute([$newFirstName, $id]);
                        $_SESSION ['firstName'] = $newFirstName;
                        //prevenir l'utilisateur
                        echo 'prénom modifié';

                    }
                    else {
                        echo 'mot de passe ou prénom incorect';
                    }
                }
                else{
                    echo 'veuillez remplir tout les champs';
                }
            }
            else{
                echo 'remplir le formulaire pour changer de prénom';
            }
            // --- FIN LOGIQUE D'ORIGINE ---
            ?>
        </div>

        <form action="" method="POST">
            
            <div class="form-group">
                <label for="oldFirstName" class="form-label">Ancien prénom :</label>
                <input type="text" id="oldFirstName" name="oldFirstName" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="newFirstName" class="form-label">Nouveau prénom :</label>
                <input type="text" id="newFirstName" name="newFirstName" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="pwd" class="form-label">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" class="form-input" required>
            </div>

            <button type="submit" class="btn-submit">Modifier le prénom</button>
        </form>
    </div>

    <div class="bottom-spacer"></div>

</section>