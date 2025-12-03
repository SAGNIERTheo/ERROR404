<?php
// On récupère l'ID
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Suppression sécurisée
        $stmt = $pdo->prepare("DELETE FROM event WHERE id = ?");
        $stmt->execute([$id]);
        
        // (Optionnel) Ici tu pourrais ajouter un message de succès en session
    } catch (PDOException $e) {
        
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
}

// Redirection vers la liste
echo "<script>window.location.href='?page=adminEvents';</script>";
exit;
?>