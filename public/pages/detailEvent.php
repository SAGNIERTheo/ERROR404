<?php
// On récupère l'ID passé dans l'URL (ex: ?page=event_detail&id=42)
$eventId = $_GET['id'] ?? null;

// Si pas d'ID, on redirige vers la liste (sécurité)
if (!$eventId) {
    header("Location: ?page=events");
    exit();
}

// Récupération des détails de l'événement
$sql = "SELECT * FROM event WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$eventId]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'événement n'existe pas dans la BDD
if (!$event) {
    echo "Événement introuvable.";
    exit();
}

// Formatage de la date (Optionnel, pour faire joli)
$dateEvent = new DateTime($event['dateStart']);
?>

<!-- Style spécifique pour cette page -->
<style>
    .detail-container {
        background-color: white;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Image Header en haut de page */
    .detail-header-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        position: relative;
    }

    /* Bouton retour flottant */
    .btn-back {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.8);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: black;
        font-weight: bold;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 10;
    }

    .detail-content {
        padding: 25px;
        border-radius: 25px 25px 0 0; /* Arrondi vers le haut */
        margin-top: -30px; /* Chevauche l'image */
        background: white;
        position: relative;
        flex: 1;
    }

    .event-category {
        color: #0044FF;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .event-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        color: #1c1c1e;
    }

    .info-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        color: #555;
        font-size: 0.95rem;
    }
    
    .info-icon {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .description-block {
        margin-top: 30px;
        line-height: 1.6;
        color: #444;
    }

    /* Bouton d'action fixe en bas */
    .fixed-bottom-action {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 380px;
    }

    .btn-participate {
        display: block;
        width: 100%;
        background-color: #0044FF;
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(0, 68, 255, 0.3);
    }
</style>

<div class="detail-container">
    
    <!-- Bouton Retour -->
    <a href="?page=events" class="btn-back">
        <!-- Flèche SVG -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </a>

    <!-- Image Principale -->
    <img src="<?= htmlspecialchars($event['image']) ?>" alt="Image Event" class="detail-header-img">

    <!-- Contenu -->
    <div class="detail-content">
        
        <div class="event-category">Événement</div>
        
        <h1 class="event-title"><?= htmlspecialchars($event['name']) ?></h1>

        <!-- Info Date -->
        <div class="info-row">
            <div class="info-icon">📅</div> 
            <div>
                <?= $dateEvent->format('d/m/Y') ?> à <?= $dateEvent->format('H:i') ?>
            </div>
        </div>

        <!-- Info Lieu (Si tu as une colonne 'location' ou 'address') -->
        <?php if (!empty($event['location'])): ?>
        <div class="info-row">
            <div class="info-icon">📍</div>
            <div><?= htmlspecialchars($event['location']) ?></div>
        </div>
        <?php endif; ?>

        <!-- Description -->
        <div class="description-block">
            <h3>À propos</h3>
            <p>
                <!-- Utilisation de nl2br pour garder les sauts de ligne de la BDD -->
                <?= nl2br(htmlspecialchars($event['description'] ?? "Aucune description pour cet événement.")) ?>
            </p>
        </div>

    </div>

    <!-- Bouton d'action -->
    <div class="fixed-bottom-action">
        <a href="#" class="btn-participate">Je participe</a>
    </div>

</div>