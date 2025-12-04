<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';

    // Sécurité : On vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['id'])) {
        header('Location: ?page=login');
        exit;
    }

    // Récupération des infos dynamiques
    $pseudo = $_SESSION['pseudo'] ?? 'Utilisateur'; 
    $initial = strtoupper(substr($pseudo, 0, 1));  
?>

<head>
    <style>

        .avatar-letter {
            width: 100%;
            height: 100%;
            background-color: #1c1c1e; 
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .logo-profile {
            border-radius: 50%;
            overflow: hidden;
            width: 100px; 
            height: 100px;
            margin: 0 auto 20px auto; 
        }


        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 100px; 
        }
    </style>
</head>

<section class="profile-container">
    
    <div class="logo-profile">
        <!-- Remplacement de <img> par la lettre stylisée -->
        <div class="avatar-letter">
            <?= $initial ?>
        </div>
    </div>

    <!-- Pseudo Dynamique -->
    <h2 class="h2-profile"><?= htmlspecialchars($pseudo) ?></h2>

    <!-- Navigation du profil -->
    
    <a href="?page=modifyProfil">
        <button class="btn-profile-bleu">Modifier mon profil</button>
    </a>

    <a href="?page=alerts">
        <button class="btn-profile-noir">Notifications</button>
    </a>

    <!-- J'ai ajouté le lien vers 'Mes inscriptions' (Events Futurs) car c'est utile -->
    <a href="?page=eventUser">
        <button class="btn-profile-bleu">Mes prochaines inscriptions</button>
    </a>

    <!-- Lien vers l'historique que nous avons créé -->
    <a href="?page=pastEventUser">
        <button class="btn-profile-bleu">Mes anciens évènements</button>
    </a>

    <!-- Lien vers l'organigramme V2 -->
    <a href="?page=organigrammeBDE">
        <button class="btn-profile-noir">Organigramme BDE</button>
    </a>

    <a href="?page=logout">
        <button class="btn-profile-bleu" style="background-color:#ff3b30;">Se déconnecter</button>
    </a>

</section>