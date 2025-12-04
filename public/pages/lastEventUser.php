<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';

    // Sécurité : On s'assure que l'utilisateur est connecté
    if (!isset($_SESSION['id'])) {
        header('Location: ?page=login');
        exit;
    }

    $userId = $_SESSION['id'];

    // 1. Préparation de la requête (FILTRÉE PAR USER & DATE PASSÉE)
    // On récupère les events liés à l'utilisateur dont la date est PASSÉE (< NOW())
    // On trie par date DESCendante (du plus récent au plus vieux)
    $sql = "SELECT e.id, e.name, e.image, e.dateStart 
            FROM event e
            JOIN user_has_event uhe ON e.id = uhe.event_id
            WHERE uhe.user_id = ? AND e.dateStart < NOW() 
            ORDER BY e.dateStart DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $pastEvents = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<head>
    <style>
        /* Style spécifique pour les events passés (optionnel : légèrement grisé) */
        .past-event-card {
            filter: grayscale(20%); /* Petit effet visuel pour dire "c'est passé" */
            transition: filter 0.3s;
        }
        .past-event-card:hover {
            filter: grayscale(0%);
        }
    </style>
</head>

<section class="app-container">

    <!-- TITRE -->
    <h1 class="page-title">Historique</h1>

    <!-- LOGIQUE D'AFFICHAGE -->
    <?php if (empty($pastEvents)): ?>
        
        <!-- Cas Vide -->
        <div class="empty-message">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:15px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <p>Vous n'avez participé à aucun événement passé.</p>
        </div>

    <?php else: ?>

        <!-- Boucle sur les événements passés -->
        <?php foreach ($pastEvents as $event): ?>
            
            <div class="hero-section event-spacer">
                
                <!-- Lien vers la page détail avec ID -->
                <a href="?page=detailEvent&id=<?= $event['id'] ?>" class="event-link">
                    <div class="hero-card past-event-card">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="Affiche event" class="hero-bg">
                        <div class="hero-overlay"></div>
                        <div class="hero-text">
                            - Évènement Passé -<br>
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