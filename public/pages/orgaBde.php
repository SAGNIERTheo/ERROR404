<?php
    include_once './public/includes/nav.php';
?>

<head>
    <style>

        /* Header Moderne */
        .orga-header {
            text-align: center;
            padding: 40px 20px 30px 20px;
            background: transparent; /* Fond transparent pour le dégradé */
            margin-bottom: 10px;
        }

        .orga-logo {
            width: 110px;
            height: 110px;
            border-radius: 35px; /* Forme plus carrée arrondie */
            object-fit: cover;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0,68,255,0.2); /* Ombre bleue */
            border: 4px solid #fff;
        }

        .orga-title {
            font-size: 28px;
            font-weight: 900;
            color: #1c1c1e;
            margin-bottom: 5px;
        }

        .orga-subtitle {
            font-size: 16px;
            color: #0044FF;
            font-weight: 600;
        }

        /* Conteneur Principal */
        .orga-content {
            padding: 0 25px;
        }

        /* Section Labels */
        .section-label {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            color: #8e8e93;
            margin: 30px 0 20px 0;
            letter-spacing: 1px;
            text-align: center;
            position: relative;
        }
        .section-label::after {
            content: '';
            display: block;
            width: 40px;
            height: 3px;
            background: #0044FF;
            margin: 10px auto 0 auto;
            border-radius: 2px;
        }

        /* --- CARTES --- */
        .role-card {
            background: white;
            border-radius: 24px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Style Spécifique Président (Plus grand, en haut) */
        .card-president {
            padding: 35px 25px;
            background: linear-gradient(135deg, #0044FF 0%, #007BFF 100%);
            color: white;
        }
        .card-president .role-title { color: white; opacity: 0.9; }
        .card-president .role-names { color: white; font-size: 20px; font-weight: 700; }

        /* Style Spécifique Bureau (Layout en grille) */
        .bureau-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .bureau-grid .role-card {
            margin-bottom: 0; /* Géré par le gap */
            padding: 20px 15px;
        }

        /* Style Spécifique Pôles (Lignes colorées) */
        .pole-card {
            text-align: left;
            padding-left: 35px; /* Espace pour la barre latérale */
        }
        .pole-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 8px;
            height: 100%;
            background: #0044FF; /* Couleur par défaut */
        }
        /* Couleurs différentes par pôle (optionnel) */
        .pole-com::before { background: #FF3B30; } /* Rouge */
        .pole-event::before { background: #34C759; } /* Vert */
        .pole-part::before { background: #FF9500; } /* Orange */

        .role-title {
            color: #0044FF;
            font-weight: 800;
            font-size: 15px;
            text-transform: uppercase;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .role-names {
            font-size: 17px;
            color: #1c1c1e;
            font-weight: 600;
            line-height: 1.6;
        }
        .role-names span { display: block; }

        /* Cale pour le scroll */
        .bottom-spacer {
            height: 120px;
            width: 100%;
            flex-shrink: 0;
        }
    </style>
</head>

<section class="app-container-orga">

    <!-- EN-TÊTE V2 -->
    <div class="orga-header">
        <img src="./assets/images/logo2.jpg" alt="Logo BDE" class="orga-logo">
        <h1 class="orga-title">L'équipe BDE</h1>
        <p class="orga-subtitle">Bureau 2025 - 2026</p>
    </div>

    <div class="orga-content">

        <div class="section-label">Le Bureau</div>

        <!-- Président (Carte unique en haut) -->
        <div class="role-card card-president">
            <div class="role-title">Président</div>
            <div class="role-names">Martins Peixoto Adam</div>
        </div>

        <!-- Reste du bureau (Grille 2 colonnes) -->
        <div class="bureau-grid">
            <div class="role-card">
                <div class="role-title">Vice-présidente</div>
                <div class="role-names">Danet Axelle</div>
            </div>
            <div class="role-card">
                <div class="role-title">Secrétaire Générale</div>
                <div class="role-names">Drouin Maëlly</div>
            </div>
            <!-- Trésorière en pleine largeur en dessous -->
        </div>
        <div class="role-card" style="margin-top:15px;">
            <div class="role-title">Trésorière</div>
            <div class="role-names">Moisan Océana</div>
        </div>


        <!-- LES PÔLES V2 -->
        <div class="section-label">Les Pôles</div>

        <div class="role-card pole-card pole-com">
            <div class="role-title" style="color:#FF3B30">Communication</div>
            <div class="role-names">
                <span>Pomart Lory</span>
                <span>Lebesne Mike</span>
                <span>Clerc Louis</span>
            </div>
        </div>

        <div class="role-card pole-card pole-event">
            <div class="role-title" style="color:#34C759">Évènementiel</div>
            <div class="role-names">
                <span>Adjassa Aimé</span>
                <span>Guerrain Corinthe</span>
                <span>Varel Mathis</span>
                <span>Meziane Mathys</span>
                <span>Delamare Paul</span>
            </div>
        </div>

        <div class="role-card pole-card pole-part">
            <div class="role-title" style="color:#FF9500">Partenariat / Sponsoring</div>
            <div class="role-names">
                <span>Djoubri Imrane</span>
                <span>Leguay Grégory</span>
            </div>
        </div>

    </div>

    <div class="bottom-spacer"></div>

</section>