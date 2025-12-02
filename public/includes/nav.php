<?php
// Fichier de navigation inclus
?>
<head>
    <style>
        /* CSS Spécifique à la navigation Mobile */
        
        #container-nav {
            /* Positionnement Fixe en bas */
            position: fixed;
            bottom: 0;
            left: 50%; /* On le place au milieu de l'écran */
            transform: translateX(-50%); /* Et on le centre parfaitement */
            
            /* Dimensions contraintes pour le mobile */
            width: 100%;
            max-width: 414px; /* Ne dépassera jamais la largeur d'un gros téléphone */
            height: 70px; /* Hauteur standard mobile (réduit de 160px à 70px) */
            
            /* Design */
            background-color: white;
            border-top: 1px solid #e5e5ea; /* Gris clair discret */
            
            /* Flexbox pour espacer les icônes */
            display: flex;
            flex-direction: row;
            justify-content: space-around; /* Espacement automatique égal */
            align-items: center;
            
            /* Suppression du padding énorme de 100px */
            padding-bottom: 10px; /* Petit espace pour la barre de swipe iPhone */
            z-index: 1000;
        }

        /* Conteneur de l'icône */
        .icon-nav {
            width: 28px; /* Taille réduite pour mobile (au lieu de 60px) */
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.6; /* Gris par défaut */
            transition: opacity 0.2s;
        }

        /* Effet au survol ou actif */
        .icon-nav:hover, .icon-nav.active {
            opacity: 1; /* Noir complet si sélectionné */
        }

        .icon-nav img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<section id="container-nav">
    <a href="?page=dashboard">
        <div class="icon-nav">
            <!-- Vérifie bien que tes images sont dans assets/images/nav/ -->
            <img src="./assets/images/nav/Home.png" alt="Home">
        </div>
    </a>
    <a href="?page=events">
        <div class="icon-nav">
            <img src="./assets/images/nav/event.png" alt="Event">
        </div>
    </a>
    <a href="?page=alerts">
        <div class="icon-nav">
            <img src="./assets/images/nav/alert.png" alt="Alert">
        </div>
    </a>
    <a href="?page=profile">
        <div class="icon-nav">
            <img src="./assets/images/nav/profil.png" alt="Profile">
        </div>
    </a>
</section>