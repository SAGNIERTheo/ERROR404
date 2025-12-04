<?php


?>

<head>
    <style>
        /* Conteneur Mobile : Simule l'écran d'un téléphone */
        .app-container {
            width: 100vw;
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 0 20px 40px 20px; /* Padding bas plus grand pour les boutons */
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        /* --- HEADER (TITRE) --- */
        .header {
            padding-top: 60px; /* Espace pour la status bar */
            padding-bottom: 20px;
            text-align: center;
        }

        .app-title {
            color: #0044FF; /* Le Bleu électrique de la maquette */
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-transform: uppercase;
        }

        /* --- CARTE POST --- */
        .post-card {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        /* En-tête du post (User info) */
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 15px;
            color: #000;
        }

        .group-name {
            font-weight: 400;
            color: #000;
        }

        .post-time {
            font-size: 13px;
            color: #8e8e93; /* Gris iOS */
            margin-top: 2px;
        }

        .options-menu {
            font-size: 20px;
            color: #000;
            letter-spacing: 2px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Image du post */
        .post-image-container {
            width: 100%;
            border-radius: 16px; /* Arrondis de la maquette */
            overflow: hidden;
            margin-bottom: 12px;
            aspect-ratio: 1/1; /* Carré comme sur Insta/Maquette */
            background-color: #eee;
        }

        .post-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Contenu du post (Texte + Stats) */
        .post-text {
            font-size: 15px;
            color: #000;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        .post-stats {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }

        .icon {
            width: 22px;
            height: 22px;
            stroke-width: 2;
        }


        .pagination-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
            margin-bottom: auto; 
        }

        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #d1d1d6;
        }
        
        .dot.active {
            background-color: #8e8e93;
        }


        .actions-container {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 50px;
            border-radius: 8px; 
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .btn:active {
            opacity: 0.8;
        }

        .btn-login {
            background-color: #1c1c1e; 
            color: #ffffff;
        }

        .btn-register {
            background-color: #0044FF; 
            color: #ffffff;
        }

    </style>
</head>
<body>

    <div class="app-container">
        
        <!-- HEADER -->
        <div class="header">
            <h1 class="app-title">ERROR 404</h1>
        </div>

        <!-- POST CARD -->
        <div class="post-card">
            
            <!-- Info Utilisateur -->
            <div class="post-header">
                <!-- Avatar placeholder -->
                <img src="https://i.pravatar.cc/150?u=helena" alt="Helena" class="avatar">
                
                <div class="user-info">
                    <div class="user-name">
                        Adam <span class="group-name">du BDE 'ERROR404'</span>
                    </div>
                    <div class="post-time">17 min ago</div>
                </div>

                <div class="options-menu">•••</div>
            </div>

            <!-- Image Principale -->
            <div class="post-image-container">
                <!-- Image de bouteilles/bar -->
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/e1/68/23/pub-o-kallaghan-s.jpg?w=500&h=-1&s=1" alt="Soirée Bar" class="post-image">
            </div>

            <!-- Texte -->
            <p class="post-text">
                Soirée bar vendredi 04/02/26 à 21h a l'O'Kallaghan's ! Venez nombreux 🍻
            </p>

            <!-- Likes & Commentaires -->
            <div class="post-stats">
                <div class="stat-item">
                    <!-- Icône Coeur -->
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    21 likes
                </div>
                <div class="stat-item">
                    <!-- Icône Bulle -->
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                    4 comments
                </div>
            </div>

        </div>

        <!-- PETITS POINTS DE PAGINATION -->
        <div class="pagination-dots">
            <div class="dot"></div>
            <div class="dot active"></div> <!-- Le point gris foncé -->
            <div class="dot"></div>
        </div>

        <!-- BOUTONS BAS DE PAGE -->
        <div class="actions-container">
            <a href="?page=login" class="btn btn-login">Se connecter</a>
            <a href="?page=register" class="btn btn-register">S'inscrire</a>
        </div>

    </div>