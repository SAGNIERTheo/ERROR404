<?php

// 1. Récupération de l'ID
$eventId = $_GET['id'] ?? null;

// Sécurité : Si pas d'ID, retour aux events
if (!$eventId) {
    echo "<script>window.location.href='?page=events';</script>";
    exit;
}

// 2. Récupération des infos de l'événement
// On prépare la requête pour éviter les injections SQL
$sql = "SELECT * FROM event WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$eventId]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'événement n'existe pas
if (!$event) {
    echo "<div style='padding:20px; text-align:center;'>Événement introuvable. <a href='?page=events'>Retour</a></div>";
    exit;
}

// Formatage de la date
$dateEvent = new DateTime($event['dateStart']);
$dateEndEvent = new DateTime($event['dateEnd']);
?>

<style>
    /* CSS SPÉCIFIQUE À LA PAGE DÉTAIL */
    /* On utilise !important pour s'assurer que ça passe par dessus le style global si besoin */
    
    .detail-container {
        background-color: white;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 414px;
        margin: 0 auto; /* Centrage si sur desktop */
        position: relative;
    }

    /* Image Header en haut de page */
    .detail-header-img {
        width: 100%;
        height: 350px; /* Grande image immersive */
        object-fit: cover;
        position: relative;
        z-index: 1;
    }

    /* Bouton retour flottant */
    .btn-back {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.9);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: black;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 100; /* Très haut pour être cliquable */
        cursor: pointer;
    }

    .detail-content {
        padding: 30px 25px 100px 25px; /* Padding bas pour laisser place au bouton */
        border-radius: 30px 30px 0 0; /* Arrondi vers le haut */
        margin-top: -40px; /* Chevauche l'image */
        background: white;
        position: relative;
        z-index: 2; /* Passe au dessus de l'image */
        flex: 1;
    }

    .event-category {
        color: #0044FF;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }

    .event-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: #1c1c1e;
        line-height: 1.2;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 18px;
        color: #333;
        font-size: 0.95rem;
    }
    
    .info-icon {
        margin-right: 15px;
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
    }

    .description-block {
        margin-top: 35px;
        border-top: 1px solid #f0f0f0;
        padding-top: 25px;
    }

    .description-block h3 {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #1c1c1e;
    }

    .description-text {
        line-height: 1.6;
        color: #666;
        font-size: 0.95rem;
    }

    /* Bouton d'action fixe en bas */
    .fixed-bottom-action {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 380px;
        z-index: 50;
    }

    .btn-participate {
        display: block;
        width: 100%;
        background-color: #0044FF;
        color: white;
        text-align: center;
        padding: 16px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        box-shadow: 0 10px 20px rgba(0, 68, 255, 0.25);
        transition: transform 0.1s;
    }
    .btn-participate:active { transform: translateX(-50%) scale(0.98); }
</style>

<div class="detail-container">
    
    <!-- Bouton Retour (Revient à la liste) -->
    <a href="?page=events" class="btn-back">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
    </a>

    <!-- Image Principale -->
    <img src="<?= htmlspecialchars($event['image']) ?>" alt="Image Event" class="detail-header-img">

    <!-- Contenu -->
    <div class="detail-content">
        
        <div class="event-category">Événement BDE</div>
        
        <h1 class="event-title"><?= htmlspecialchars($event['name']) ?></h1>

        <!-- Infos -->
        <div class="info-row">
            <div class="info-icon">🗓</div> 
            <div>
                <strong><?= $dateEvent->format('d F Y') ?></strong><br>
                <span style="color:#666">de <?= $dateEvent->format('H:i') ?></span>
                <span style="color:#666">jusqu'à <?= $dateEndEvent->format('H:i') ?></span>
            </div>
        </div>

        <?php if (!empty($event['location'])): ?>
        <div class="info-row">
            <div class="info-icon">📍</div>
            <div>
                <strong>Lieu</strong><br>
                <?= htmlspecialchars($event['location']) ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Description -->
        <div class="description-block">
            <h3>À propos</h3>
            <p class="description-text">
                <?= nl2br(htmlspecialchars($event['description'] ?? "Aucune description disponible.")) ?>
            </p>
        </div>

    </div>

    <!-- Bouton d'action -->
    <div class="fixed-bottom-action">
        <a href="#" class="btn-participate">Je participe</a>
    </div>

</div>