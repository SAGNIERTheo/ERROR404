<?php
    include_once './public/includes/nav.php';

    // --- 1. FONCTION UTILITAIRE (Pour l'affichage des dates) ---
    function formatTimeRemaining($dateStr) {
        $eventDate = new DateTime($dateStr);
        $now = new DateTime();
        $interval = $now->diff($eventDate);

        if ($interval->invert) return "En cours";
        if ($interval->days == 0) return "Aujourd'hui à " . $eventDate->format('H:i');
        if ($interval->days == 1) return "Demain à " . $eventDate->format('H:i');
        return "Dans " . $interval->days . " jours";
    }

    // --- 2. LOGIQUE HERO (Le prochain événement GLOBAL) ---
    // On garde le prochain gros événement pour tout le monde en mise en avant
    $sqlHero = "SELECT name, image FROM event
            WHERE dateStart >= NOW() 
            ORDER BY dateStart ASC 
            LIMIT 1";
    $stmtHero = $pdo->query($sqlHero);
    $nextEvent = $stmtHero->fetch(PDO::FETCH_ASSOC);

    // Gestion de l'affichage par défaut
    if ($nextEvent) {
        $heroImage = $nextEvent['image'];
        $heroTitle = $nextEvent['name'];
    } else {
        $heroImage = "https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"; 
        $heroTitle = "Aucun événement à venir";
    }

    // --- 3. LOGIQUE ALERTES (Les 2 prochains événements GLOBAUX) ---
    $sqlNotifs = "SELECT id, name, image, dateStart FROM event
            WHERE dateStart >= NOW() 
            ORDER BY dateStart ASC
            LIMIT 2";
    $stmtNotifs = $pdo->query($sqlNotifs);
    $notifs = $stmtNotifs->fetchAll(PDO::FETCH_ASSOC);

    // --- 4. LOGIQUE CAROUSEL (MES ÉVÉNEMENTS) ---
    // ✅ MODIFICATION ICI : On filtre par l'ID de l'utilisateur connecté
    $userId = $_SESSION['id'];

    $sqlCarousel = "SELECT e.id, e.name, e.image 
                    FROM event e
                    JOIN user_has_event uhe ON e.id = uhe.event_id
                    WHERE uhe.user_id = ? AND e.dateStart >= NOW() 
                    ORDER BY e.dateStart ASC";
    
    $stmtCarousel = $pdo->prepare($sqlCarousel);
    $stmtCarousel->execute([$userId]);
    $myEvents = $stmtCarousel->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Style spécifique pour les petites corrections d'alignement -->
<head>
    <style>
        .event-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
            background-color: #eee;
        }
        
        .event-icon-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-see-event {
            background-color: #F2F2F7;
            color: #0044FF;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }
        
        /* Cale pour le scroll (Nav fixe) */
        .bottom-spacer { height: 100px; width: 100%; flex-shrink: 0; }
        
        /* Correctif container */
        .app-container { min-height: 100vh; height: auto !important; flex: 1 0 auto; padding-bottom: 0 !important; }
    </style>
</head>

<section class="app-container">

    <!-- FILTRES -->
    <div class="filters-scroll">
        <div class="chip">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            Historique
        </div>
        <div class="chip">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
            Suivis
        </div>
        <div class="chip">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Parcours
        </div>
    </div>

    <!-- HERO SECTION (Prochain Event) -->
    <a href="?page=events" style="text-decoration:none;">
        <div class="hero-section">
            <div class="hero-card">
                <img src="<?= htmlspecialchars($heroImage) ?>" alt="Affiche prochain event" class="hero-bg">
                <div class="hero-overlay"></div>
                <div class="hero-text">
                    - Évènement -<br>
                    Prochain évènement : <?= htmlspecialchars($heroTitle) ?>
                </div>
            </div>
        </div>
    </a>

    <!-- LISTE DES 2 DERNIÈRES ALERTES -->
    <div class="activity-list">
        <?php if (empty($notifs)): ?>
            <p style="text-align:center; color:#999; padding:20px;">Aucune alerte récente.</p>
        <?php else: ?>
            
            <?php foreach ($notifs as $notif): ?>
                <div class="activity-item">
                    <div class="new-indicator" style="background-color: #0044FF;"></div> 

                    <div class="event-icon-wrapper">
                        <img src="<?= htmlspecialchars($notif['image']) ?>" alt="Icon" class="event-icon-img">
                    </div>

                    <div class="activity-content">
                        <div class="user-name">
                            <?= htmlspecialchars($notif['name']) ?>
                        </div>
                        
                        <div class="activity-desc" style="color: #0044FF; font-weight: 500;">
                            <?= formatTimeRemaining($notif['dateStart']) ?>
                        </div>
                    </div>

                    <a href="?page=detailEvent&id=<?= $notif['id'] ?>" class="btn-see-event">
                        Voir
                    </a>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <!-- Logo ERROR404 -->
    <h2 class="bde-title">ERROR 404</h2>

    <!-- MES ÉVÉNEMENTS (CAROUSEL) -->
     <a href="#">
        <div class="section-header">
            <div class="section-title">Mes évènements</div>
            <div class="see-more-icon">›</div>
        </div>
    </a>

    <div class="events-carousel">
        
        <?php if (empty($myEvents)): ?>
            <div style="padding: 20px; color: #999; font-size: 14px;">
                Tu ne participes à aucun événement à venir.<br>
                <a href="?page=events" style="color:#0044FF; text-decoration:none; font-weight:600;">Découvrir les événements</a>
            </div>
        <?php else: ?>
            
            <?php foreach ($myEvents as $evt): ?>
                <!-- Carte Événement Dynamique (FILTRÉE PAR USER) -->
                <div class="event-card">
                    <a href="?page=detailEvent&id=<?= $evt['id'] ?>" style="text-decoration: none; color: inherit;">
                        <img src="<?= htmlspecialchars($evt['image']) ?>" class="event-img" alt="<?= htmlspecialchars($evt['name']) ?>">
                        <div class="event-brand">Inscrit ✅</div>
                        <div class="event-name"><?= htmlspecialchars($evt['name']) ?></div>
                    </a>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    <!-- Cale invisible pour la nav -->
    <div class="bottom-spacer"></div>

</section>