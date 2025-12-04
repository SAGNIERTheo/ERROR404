<?php

// Récupérer le nombre total de ligne dans la table 'user'
$stmt = $pdo->query("SELECT COUNT(*) FROM user");
$totalUsers = $stmt->fetchColumn(); 

$stmt = $pdo->query("SELECT COUNT(*) FROM event");
$totalEvents = $stmt->fetchColumn();

$sql = "SELECT name, image FROM event
        WHERE dateStart >= NOW() 
        ORDER BY dateStart ASC 
        LIMIT 1";

$stmt = $pdo->query($sql);
$nextEvent = $stmt->fetch(PDO::FETCH_ASSOC);

// Gestion de l'image par défaut
// Si $nextEvent est faux (pas de résultat), on met une titre/image par défaut
if ($nextEvent) {
    $heroImage = $nextEvent['image'];
    $heroTitle = $nextEvent['name'];
} else {
    // Une image/title par défaulkt si rien n'est prévu 
    $heroImage = "https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"; 
    $heroTitle = "Aucun événement à venir";
}


?>


<div class="admin-wrapper">

<?php include 'public/includes/admin/adminSideBar.php'; ?>

    <main class="admin-main-content">
        
        <div class="admin-top-bar">
            <h2 class="admin-page-title">Dashboard</h2>
            <a href="?page=addEventAdmin" class="admin-btn-add-event">
                <span>+</span> Ajouter un évènement
            </a>
        </div>

        <div class="admin-stats-grid">
            <div class="admin-stat-card">
                <div class="admin-stat-label">Adhérents Totaux</div>
                <span class="admin-stat-value"><?= $totalUsers ?></span>
                <a href="?page=adminUsers" class="admin-stat-link">Voir les adhérents</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Paiement - Attente</div>
                <span class="admin-stat-value">#aFaire</span>
                <a href="#" class="admin-stat-link">Paiement en attente (8)</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Messagerie - Attente</div>
                <span class="admin-stat-value">#aFaire</span>
                <a href="?page=adminMessages" class="admin-stat-link">Voir votre messagerie</a>
            </div>
        </div>

        <div class="admin-stat-card admin-stat-card-small">
            <div class="admin-stat-label">Évènements en cours</div>
            <span class="admin-stat-value"><?= $totalEvents ?></span>
            <a href="?page=adminEvents" class="admin-stat-link">voir les évènements</a>
        </div>

        <div class="admin-hero">
        <div>
            <!-- insertion de la variable $heroImage avec htmlspe... car lien dans la base de donnée -->
            <img src="<?= htmlspecialchars($heroImage) ?>" alt="Affiche prochain event" class="hero-bg">
            
            <div class="hero-overlay"></div>
            
            <div class="hero-text">
                - Évènement -<br>
                Prochain évènement : <?= htmlspecialchars($heroTitle) ?>
            </div>
        </div>

    </main>

</div>
