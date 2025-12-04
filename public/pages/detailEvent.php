<?php
$eventId = $_GET['id'] ?? null;

if (!$eventId) {
    header("Location: ?page=events");
    exit();
}

$sql = "SELECT * FROM event WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$eventId]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "Événement introuvable.";
    exit();
}

$dateEvent = new DateTime($event['dateStart']);


$userId = $_SESSION['id'] ?? null;
$isParticipating = false;

if ($userId) {
    // Vérifier si l'utilisateur participe déjà
    $checkSql = "SELECT * FROM user_has_event WHERE user_id = ? AND event_id = ?";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([$userId, $eventId]);
    // Si on trouve une ligne, c'est qu'il participe
    $isParticipating = $checkStmt->rowCount() > 0;

    // Traitement du clic sur le bouton
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_participation'])) {
        
        // récupère les infos de l'utilisateur (rôle et promo) requises par ta table pivot
        $userSql = "SELECT roles_id, promo_id FROM user WHERE id = ?";
        $userStmt = $pdo->prepare($userSql);
        $userStmt->execute([$userId]);
        $userInfo = $userStmt->fetch(PDO::FETCH_ASSOC);

        if ($userInfo) {
            if ($isParticipating) {

                $deleteSql = "DELETE FROM user_has_event WHERE user_id = ? AND event_id = ?";
                $delStmt = $pdo->prepare($deleteSql);
                $delStmt->execute([$userId, $eventId]);
            } else {

                // On insère user_id, event_id MAIS AUSSI roles_id et promo_id comme demandé par ta structure BDD
                $insertSql = "INSERT INTO user_has_event (user_id, user_roles_id, user_promo_id, event_id) VALUES (?, ?, ?, ?)";
                $insStmt = $pdo->prepare($insertSql);
                $insStmt->execute([
                    $userId, 
                    $userInfo['roles_id'], 
                    $userInfo['promo_id'], 
                    $eventId
                ]);
            }
            // Rechargement pour mettre à jour l'affichage du bouton
            echo "<script>window.location.href='?page=detailEvent&id=$eventId';</script>";
            exit;
        }
    }
}

?>

<div class="detail-container">
    
    <a href="?page=events" class="btn-back">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </a>

    <img src="<?= htmlspecialchars($event['image']) ?>" alt="Image Event" class="detail-header-img">

    <div class="detail-content">
        
        <div class="event-category">Événement</div>
        
        <h1 class="event-title"><?= htmlspecialchars($event['name']) ?></h1>

        <div class="info-row">
            <div class="info-icon">📅</div> 
            <div>
                <?= $dateEvent->format('d/m/Y') ?> à <?= $dateEvent->format('H:i') ?>
            </div>
        </div>

        <?php if (!empty($event['place'])): ?>
        <div class="info-row">
            <div class="info-icon">📍</div>
            <div><?= htmlspecialchars($event['place']) ?></div>
        </div>
        <?php endif; ?>

        <div class="description-block">
            <h3>À propos</h3>
            <p>
                <?= nl2br(htmlspecialchars($event['description'] ?? "Aucune description pour cet événement.")) ?>
            </p>
        </div>

    </div>


    <div class="fixed-bottom-action">
        <form method="POST">
            <!-- Input caché pour identifier l'action -->
            <input type="hidden" name="toggle_participation" value="1">
            
            <?php if ($isParticipating): ?>
                <!-- Bouton si déjà inscrit -->
                <button type="submit" class="btn-participate" style="background-color: #E5E5EA; color: #333;">
                    ✓ Déjà inscrit (Se désinscrire)
                </button>
            <?php else: ?>
                <!-- Bouton si pas inscri -->
                <button type="submit" class="btn-participate">
                    Je participe
                </button>
            <?php endif; ?>
        </form>
    </div>

</div>