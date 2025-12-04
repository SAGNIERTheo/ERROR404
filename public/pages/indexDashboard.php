<?php

    include_once './public/includes/nav.php';

// Préparation de la requête pour l'affichage du prochain event
$sql = "SELECT name, image FROM event
        WHERE dateStart >= NOW() 
        ORDER BY dateStart ASC 
        LIMIT 1";

$stmt = $pdo->query($sql);
$nextEvent = $stmt->fetch(PDO::FETCH_ASSOC);

// Si $nextEvent est faux (pas de résultat), on met une titre/image par défaut
if ($nextEvent) {
    $heroImage = $nextEvent['image'];
    $heroTitle = $nextEvent['name'];
} else {
    // Une image par défaulkt si rien n'est prévu et title
    $heroImage = "https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"; 
    $heroTitle = "Aucun événement à venir";
}


$sql = "SELECT name, image FROM event
        WHERE dateStart >= NOW() 
        ORDER BY dateStart ASC 
        LIMIT 1";

$stmt = $pdo->query($sql);
$nextEvent = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Mettre en place un title Head dynamique avec js (voir doc internet) -->
<head>
    <title>Dashboard</title>
</head>
<body>

<div class="app-container">

    <!-- FILTRES (ça filtre les events et notifs en fonctions de ce qu'ils veulent) -->
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

    <!-- Mise en avant du prochain event BDE -->
     <a href="?page=events">
    <div class="hero-section">
        <div class="hero-card">
            <!-- insertion de la variable $heroImage avec htmlspe... car lien dans la base de donnée -->
            <img src="<?= htmlspecialchars($heroImage) ?>" alt="Affiche prochain event" class="hero-bg">
            
            <div class="hero-overlay"></div>
            
            <div class="hero-text">
                - Évènement -<br>
                Prochain évènement : <?= htmlspecialchars($heroTitle) ?>
            </div>
        </div>
    </div>
    </a>

    <!-- ACTIVITÉS / NOTIFS -->
    <div class="activity-list">
        
        <!-- Créer fonction pour afficher les 2 dernières notifs présentes dans alerts -->
        <div class="activity-item">
            <div class="new-indicator"></div> <!-- Point rouge -->
            <img src="https://i.pravatar.cc/150?u=jeff" class="user-avatar" alt="Jeff">
            <div class="activity-content">
                <div class="user-name">Jeff Benard <span class="time-ago">1d</span></div>
                <div class="activity-desc">Started following you</div>
            </div>
            <button class="btn-follow-back">Suivre en retour</button>
        </div>


        <div class="activity-item">
            <div class="new-indicator"></div>
            <img src="https://ui-avatars.com/api/?name=Error+404&background=0D8ABC&color=fff" class="user-avatar" alt="BDE">
            <div class="activity-content">
                <div class="user-name">Adam - BDE <span class="time-ago">1d</span></div>
                <div class="activity-desc">New post</div>
            </div>
            <div>
                <img src="#" class="post-thumb" alt="image bar">
            </div>
        </div>

    </div>

    <!-- Logo ERROR404 -->
    <h2 class="bde-title">ERROR 404</h2>

    <!-- Les évènements de l'utilisateur -->
    <div class="section-header">
        <div class="section-title">Mes évènements</div>
        <div class="see-more-icon">›</div>
    </div>

    <div class="events-carousel">
        <!-- div à répéter selons le nombres d'evenement inscrits pour l'utilisateur -->
                <div class="event-card">
                    <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" class="event-img" alt="Drink">
                    <div class="event-brand">Error404</div>
                    <div class="event-name">Cocktail Class</div>
                </div>

        <!-- Exemple en attendant la logique php -->
        <div class="event-card">
            <img src="https://images.unsplash.com/photo-1543007630-9710e4a00a20?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" class="event-img" alt="Party">
            <div class="event-brand">Error404</div>
            <div class="event-name">Afterwork</div>
        </div>

        <div class="event-card">
            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" class="event-img" alt="Music">
            <div class="event-brand">Error404</div>
            <div class="event-name">Live Music</div>
        </div>
    </div>
</div>

</body>
</html>