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

    <h2 class="page-title">Modifier le nom</h2>

    <div class="form-content">
        
        <!-- Zone d'affichage des messages de la logique -->
        <div class="logic-message">
            <?php
            // --- LOGIQUE D'ORIGINE ---
            //verifier si formulaire non vide
            if (isset($_POST)&& !empty($_POST)){
                //verifier si tous les champs sont remplie
                if (!empty($_POST['oldName']) && !empty($_POST['newName']) && !empty($_POST['pwd'])){
                    //securiser contre les injection de code
                    $oldName = htmlspecialchars(trim($_POST['oldName']));
                    $newName = htmlspecialchars(trim($_POST['newName']));
                    $pwdVerify = htmlspecialchars(trim($_POST['pwd']));
                    //sortir les infos de la bdd
                    $sql = "SELECT * FROM `user` WHERE `name` LIKE '$oldName'";
                    $user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                    $id =$_SESSION['id'];
                    //verifier si l'utilisateur connait ses données de connexion
                    if ($oldName===$_SESSION['name'] && password_verify ($pwdVerify, $user['pwd'] )) {
                            //modifier le name
                            $modifyName = $pdo->prepare("UPDATE `user` SET `name` = ? WHERE `id` = ?");
                            $modifyName->execute([$newName, $id]);
                            $_SESSION ['name'] = $newName;
                            //prevenir l'utilisateur
                            echo 'nom de famille modifié';

                    }
                    else {
                        echo 'mot de passe ou nom de famille incorect';
                    }
                }
                else{
                    echo 'veuillez remplir tout les champs';
                }
            }
            else{
                echo 'remplir le formulaire pour changer de nom de famille';
            }
            // --- FIN LOGIQUE D'ORIGINE ---
            ?>
        </div>

        <form action="" method="POST">
            
            <div class="form-group">
                <label for="oldName" class="form-label">Ancien nom de famille :</label>
                <input type="text" id="oldName" name="oldName" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="newName" class="form-label">Nouveau nom de famille :</label>
                <input type="text" id="newName" name="newName" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="pwd" class="form-label">Mot de passe :</label>
                <input type="password" id="pwd" name="pwd" class="form-input" required>
            </div>

            <button type="submit" class="btn-submit">Modifier le nom</button>
        </form>
    </div>

    <div class="bottom-spacer"></div>

</section>