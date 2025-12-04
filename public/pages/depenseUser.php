<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';

    // Sécurité : On s'assure que l'utilisateur est connecté
    if (!isset($_SESSION['id'])) {
        header('Location: ?page=login');
        exit;
    }

    $userId = $_SESSION['id'];

    // Préparation de la requête (FILTRÉE PAR USER)
    // jointure pour prendre que les events lié à l'utilisateur
    // On filtre aussi pour n'afficher que les événements futurs
    $sql = "SELECT e.id, e.name, e.image, e.dateStart 
            FROM event e
            JOIN user_has_event uhe ON e.id = uhe.event_id
            WHERE uhe.user_id = ? AND e.dateStart >= NOW() 
            ORDER BY e.dateStart ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $myEvents = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<section class="app-container">

    <h1 class="page-title">Mes inscriptions</h1>

    <?php if (empty($myEvents)): ?>
        
        <div class="empty-message">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:15px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <p>Vous n'êtes inscrit à aucun événement à venir.</p>
            <a href="?page=events" class="btn-discover">Découvrir les événements</a>
        </div>

    <?php else: ?>

        <?php foreach ($myEvents as $event): ?>
            
            <div class="hero-section event-spacer">
                
                <a href="?page=detailEvent&id=<?= $event['id'] ?>" class="event-link">
                    <div class="hero-card">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="Affiche event" class="hero-bg">
                        <div class="hero-overlay"></div>
                        <div class="hero-text">
                            - Évènement Inscrit -<br>
                            <?= htmlspecialchars($event['name']) ?>
                        </div>
                    </div>
                </a>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <!-- cale pour laisser place a la nav -->
    <div class="bottom-spacer"></div>

</section>