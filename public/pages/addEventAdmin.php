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

<?php include 'public/includes/admin/adminSideBar.php'; ?>

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