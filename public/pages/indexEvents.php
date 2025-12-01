<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';

    // 1. Préparation de la requête
    // On sélectionne image, nom et date de TOUS les prochains events
    // On utilise fetchAll pour avoir une liste complète
    $sql = "SELECT name, image, dateStart FROM event
            WHERE dateStart >= NOW() 
            ORDER BY dateStart ASC";

    $stmt = $pdo->query($sql);
    $eventsList = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<head>
    <style>
        #filter-fix{
            display: flex;
            margin-right: 10px;
            gap: 15px;
        }

        #filter-section{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px; /* Ajout d'un peu de padding pour l'esthétique */
        }
        
        /* Petit ajout pour que les cartes ne soient pas collées */
        .event-spacer {
            margin-bottom: 20px;
        }
    </style>
</head>

<section class="app-container">

    <!-- SECTION FILTRES -->
    <section id="filter-section">
        <div id="filter-fix">
            <a href="#">
                <div>
                    <img src="./assets/images/filtres/filter.png" alt="Filter icon">
                </div>
            </a>
            <a href="#">
                <div>
                    <img src="./assets/images/filtres/shoppingCart2.png" alt="Cart icon">
                </div>
            </a>
        </div>
        
        <!-- FILTRES (Scroll horizontal) -->
        <div class="filters-scroll">
            <div class="chip">Évènements</div>
            <div class="chip">Tes évènements</div>
            <div class="chip">Favoris</div>
        </div>
    </section>

    <!-- LOGIQUE D'AFFICHAGE DES ÉVÉNEMENTS -->
    <?php if (empty($eventsList)): ?>
        
        <!-- CAS 1 : Aucun événement trouvé (Affichage par défaut) -->
        <div class="hero-section">
            <div class="hero-card">
                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Défaut" class="hero-bg">
                
                <div class="hero-overlay"></div>
                
                <div class="hero-text">
                    - Information -<br>
                    Aucun événement à venir
                </div>
            </div>
        </div>

    <?php else: ?>

        <!-- CAS 2 : Il y a des événements, on boucle dessus -->
        <?php foreach ($eventsList as $event): ?>
            
            <div class="hero-section event-spacer">
                <div class="hero-card">
                    <!-- Insertion dynamique de l'image de l'event -->
                    <img src="<?= htmlspecialchars($event['image']) ?>" alt="Affiche event" class="hero-bg">
                    
                    <div class="hero-overlay"></div>
                    
                    <div class="hero-text">
                        - Évènement -<br>
                        <!-- Insertion dynamique du titre -->
                        <?= htmlspecialchars($event['name']) ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</section>