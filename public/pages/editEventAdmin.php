<?php

// Récupération de l'ID et de l'événement
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>window.location.href='?page=adminEvents';</script>";
    exit;
}

// 2. Traitement du formulaire (Mise à jour)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $price = !empty($_POST['price']) ? $_POST['price'] : 0;
    $place = $_POST['place'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $registerDateEnd = $_POST['registerDateEnd'];

    try {
        $sql = "UPDATE event SET 
                name = ?, price = ?, place = ?, image = ?, description = ?, 
                dateStart = ?, dateEnd = ?, registerDateEnd = ?
                WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $price, $place, $image, $description, $dateStart, $dateEnd, $registerDateEnd, $id]);

        echo "<script>window.location.href='?page=adminEvents';</script>";
        exit;

    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}

// 3. Récupération des données actuelles pour pré-remplir le formulaire
$stmt = $pdo->prepare("SELECT * FROM event WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) die("Événement introuvable");

// Formatage des dates pour les input HTML (Y-m-d\TH:i est obligatoire pour datetime-local)
$startDateFormatted = date('Y-m-d\TH:i', strtotime($event['dateStart']));
$endDateFormatted = !empty($event['dateEnd']) ? date('Y-m-d\TH:i', strtotime($event['dateEnd'])) : '';
?>



<div class="admin-wrapper">

<?php include 'public/includes/admin/adminSideBar.php'; ?>
    
    <main class="admin-main-content">
        <div class="admin-top-bar">
            <h2 class="admin-page-title">Modifier l'événement</h2>
        </div>

        <div class="form-container">
            <form method="POST">
                
                <div class="form-group">
                    <label class="form-label">Nom de l'événement</label>
                    <input type="text" name="name" class="form-input" value="<?= htmlspecialchars($event['name']) ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-col form-group">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" name="price" class="form-input" value="<?= htmlspecialchars($event['price']) ?>">
                    </div>
                    <div class="form-col form-group">
                        <label class="form-label">Lieu</label>
                        <input type="text" name="place" class="form-input" value="<?= htmlspecialchars($event['place']) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col form-group">
                        <label class="form-label">Date de début</label>
                        <input type="datetime-local" name="dateStart" class="form-input" value="<?= $startDateFormatted ?>" required>
                    </div>
                    <div class="form-col form-group">
                        <label class="form-label">Date de fin</label>
                        <input type="datetime-local" name="dateEnd" class="form-input" value="<?= $endDateFormatted ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Date limite d'inscription</label>
                    <input type="date" name="registerDateEnd" class="form-input" value="<?= htmlspecialchars($event['registerDateEnd']) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Image (URL)</label>
                    <input type="text" name="image" class="form-input" value="<?= htmlspecialchars($event['image']) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea" rows="5"><?= htmlspecialchars($event['description']) ?></textarea>
                </div>

                <button type="submit" class="btn-submit">Enregistrer les modifications</button>
                <a href="?page=adminEvents" class="btn-cancel">Annuler</a>

            </form>
        </div>
    </main>
</div>