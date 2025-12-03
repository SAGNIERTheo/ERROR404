<?php
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Récupération des champs
    $name = $_POST['name'];
    $price = !empty($_POST['price']) ? $_POST['price'] : 0;
    $place = $_POST['place'];
    $image = $_POST['image']; // On part du principe que c'est une URL (texte)
    $description = $_POST['description'];
    
    // Dates
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $registerDateEnd = $_POST['registerDateEnd'];

    // Validation simple
    if (!empty($name) && !empty($dateStart)) {
        try {
            $sql = "INSERT INTO event 
                    (name, price, dateStart, dateEnd, registerDateEnd, place, image, description) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $name, 
                $price, 
                $dateStart, 
                $dateEnd, 
                $registerDateEnd, 
                $place, 
                $image, 
                $description
            ]);

            // Redirection vers la liste après succès
            echo "<script>window.location.href='?page=adminEvents';</script>";
            exit;

        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir les champs obligatoires (*)";
    }
}
?>


<div class="admin-wrapper">

    <!-- SIDEBAR (Identique aux autres pages) -->
    <nav class="admin-sidebar">
        <div class="admin-logo">ERROR 404</div>
        <ul class="admin-menu-list">
            <li class="admin-menu-item"><a href="?page=admin" class="admin-menu-link"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg> Dashboard</a></li>
            <li class="admin-menu-item"><a href="?page=adminEvents" class="admin-menu-link active"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Évènements</a></li>
            <li class="admin-menu-item"><a href="?page=adminMessages" class="admin-menu-link"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> Messagerie</a></li>
            <li class="admin-menu-item"><a href="?page=adminUsers" class="admin-menu-link"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Utilisateurs</a></li>
        </ul>
        <div class="admin-sidebar-profile">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Axelle" class="admin-profile-pic">
            <div class="admin-profile-name">Axelle</div>
        </div>
    </nav>

    <!-- CONTENU PRINCIPAL -->
    <main class="admin-main-content">
        <div class="admin-top-bar">
            <h2 class="admin-page-title">Nouvel événement</h2>
        </div>

        <div class="form-container">
            
            <?php if(isset($error)): ?>
                <div style="background:#FEE2E2; color:#DC2626; padding:10px; border-radius:8px; margin-bottom:15px;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                
                <!-- Nom de l'événement -->
                <div class="form-group">
                    <label class="form-label">Nom de l'événement *</label>
                    <input type="text" name="name" class="form-input" placeholder="Ex: Soirée Bar O'Sullivans" required>
                </div>

                <!-- Prix et Lieu -->
                <div class="form-row">
                    <div class="form-col form-group">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" name="price" class="form-input" placeholder="0 pour gratuit">
                    </div>
                    <div class="form-col form-group">
                        <label class="form-label">Lieu</label>
                        <input type="text" name="place" class="form-input" placeholder="Adresse ou Nom du lieu">
                    </div>
                </div>

                <!-- Dates (Début et Fin) -->
                <div class="form-row">
                    <div class="form-col form-group">
                        <label class="form-label">Date de début *</label>
                        <input type="datetime-local" name="dateStart" class="form-input" required>
                    </div>
                    <div class="form-col form-group">
                        <label class="form-label">Date de fin</label>
                        <input type="datetime-local" name="dateEnd" class="form-input">
                    </div>
                </div>

                <!-- Date Limite Inscription -->
                <div class="form-group">
                    <label class="form-label">Date limite d'inscription</label>
                    <input type="date" name="registerDateEnd" class="form-input">
                </div>

                <!-- Image URL -->
                <div class="form-group">
                    <label class="form-label">Image (URL)</label>
                    <input type="text" name="image" class="form-input" placeholder="https://exemple.com/image.jpg">
                    <small style="color:#888;">Pour l'instant, colle l'adresse d'une image trouvée sur internet.</small>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea" rows="5" placeholder="Détails de l'événement..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Créer l'événement</button>
                <a href="?page=adminEvents" class="btn-cancel">Annuler</a>

            </form>
        </div>
    </main>

</div>