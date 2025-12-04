<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';

    $sql = "SELECT id, name, image, dateStart FROM event
            WHERE dateStart >= NOW() 
            ORDER BY dateStart ASC";

    $stmt = $pdo->query($sql);
    $eventsList = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<head>
    <style>
        #filter-fix{ display: flex; margin-right: 10px; gap: 15px; }
        #filter-section{ display: flex; justify-content: space-between; align-items: center; padding: 20px; }
        .event-spacer { margin-bottom: 20px; }
    </style>
</head>

<section class="app-container">

    <!-- SECTION FILTRES (Inchangée) -->
    <section id="filter-section">
        <div id="filter-fix">
            <a href="#"><div><img src="./assets/images/filtres/filter.png" alt="Filter"></div></a>
            <a href="#"><div><img src="./assets/images/filtres/shoppingCart2.png" alt="Cart"></div></a>
        </div>
        <div class="filters-scroll">
            <div class="chip">Évènements</div>
            <div class="chip">Tes évènements</div>
            <div class="chip">Favoris</div>
        </div>
    </section>

    <!-- LOGIQUE D'AFFICHAGE -->
    <?php if (empty($eventsList)): ?>
        
        <div class="hero-section">
            <div class="hero-card">
                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Défaut" class="hero-bg">
                <div class="hero-overlay"></div>
                <div class="hero-text">- Information -<br>Aucun événement à venir</div>
            </div>
        </div>

    <?php else: ?>

        <?php foreach ($eventsList as $event): ?>
            
            <div class="hero-section event-spacer">
                
                <!-- ✅ AJOUT DU LIEN : On envoie l'ID vers la page detailEvent -->
                <a href="?page=detailEvent&id=<?= $event['id'] ?>" style="text-decoration:none; color:inherit; display:block;">
                    
                    <div class="hero-card">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="Affiche event" class="hero-bg">
                        <div class="hero-overlay"></div>
                        <div class="hero-text">
                            - Évènement -<br>
                            <?= htmlspecialchars($event['name']) ?>
                        </div>
                    </div>

                </a>
                <!-- Fin du lien -->

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <div class="bottom-spacer"></div>

</section>