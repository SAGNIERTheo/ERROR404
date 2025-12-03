<?php
    include_once './public/includes/nav.php';

    // 1. Récupération des événements futurs
    // Correction : on utilise 'place' au lieu de 'location'
    $sql = "SELECT id, name, image, dateStart, place 
            FROM event 
            WHERE dateStart >= NOW() 
            ORDER BY dateStart ASC";

    $stmt = $pdo->query($sql);
    $alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fonction helper pour afficher le temps restant
    function formatTimeRemaining($dateStr) {
        $eventDate = new DateTime($dateStr);
        $now = new DateTime();
        $interval = $now->diff($eventDate);

        if ($interval->invert) {
            return "En cours"; // Si l'événement a déjà commencé (mais reste >= NOW() selon la requête stricte ou si délai court)
        }

        if ($interval->days == 0) {
            return "Aujourd'hui à " . $eventDate->format('H:i');
        } elseif ($interval->days == 1) {
            return "Demain à " . $eventDate->format('H:i');
        } else {
            return "Dans " . $interval->days . " jours";
        }
    }
?>


<section class="app-container">

    <h2 class="page-title">Alertes</h2>

    <div class="filters-scroll" style="padding-top:0;">
        <div class="chip" style="background:#000; color:white; border:none;">Récents</div>
    </div>

    <div class="activity-list alert-container">
        
        <?php if (empty($alerts)): ?>
            
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                <p style="margin-top:10px;">Aucune nouvelle alerte pour le moment.</p>
            </div>

        <?php else: ?>

            <?php foreach ($alerts as $alert): ?>
                <div class="activity-item">
                    <!-- Indicateur visuel -->
                    <div class="new-indicator" style="background-color: #0044FF;"></div> 

                    <!-- Image -->
                    <div class="event-icon-wrapper">
                        <img src="<?= htmlspecialchars($alert['image']) ?>" alt="Icon" class="event-icon-img">
                    </div>

                    <!-- Contenu texte -->
                    <div class="activity-content">
                        <!-- Nom de l'événement en haut (Titre) -->
                        <div class="user-name">
                            <?= htmlspecialchars($alert['name']) ?>
                        </div>
                        
                        <!-- Temps restant en dessous (Description) -->
                        <div class="activity-desc" style="color: #0044FF; font-weight: 500;">
                            <?= formatTimeRemaining($alert['dateStart']) ?>
                        </div>
                    </div>

                    <!-- Bouton d'action -->
                    <a href="?page=detailEvent&id=<?= $alert['id'] ?>" class="btn-see-event">
                        Voir
                    </a>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</section>