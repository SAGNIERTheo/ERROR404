<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';

    // 1. Préparation de la requête
    // On récupère l'ID, le nom, l'image et la date
    $sql = "SELECT id, name, image, dateStart FROM event
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
            padding: 20px; 
        }
        
        .event-spacer {
            margin-bottom: 20px;
        }

        /* Force un espace vide en bas de page pour que le dernier élément ne soit pas caché */
        .bottom-spacer {
            height: 120px;
            width: 100%;
            display: block;
            flex-shrink: 0;
        }

        .app-container {
            height: auto !important; 
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
        
        <!-- CAS 1 : Aucun événement trouvé -->
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

        <!-- CAS 2 : Boucle sur les événements -->
        <?php foreach ($eventsList as $event): ?>
            
            <div class="hero-section event-spacer">
                
                <!-- Lien vers la page détail -->
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

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <!-- CALE INVISIBLE EN BAS DE PAGE -->
    <div class="bottom-spacer"></div>

</section>