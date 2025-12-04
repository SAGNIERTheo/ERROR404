<?php
// ID utilisateur à supprimer
$id = $_GET['id'] ?? null;

// on ne supprime pas si pas d'ID ou si c'est l'utilisateur connecté lui-même
if ($id && $id != $_SESSION['id']) {
    try {
        // 1. Suppression
        $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
        $stmt->execute([$id]);
        
        // Optionnel : Ajouter un message flash en session ici success/error

    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
}

// Redirection vers la liste
echo "<script>window.location.href='?page=adminUsers';</script>";
exit;
?>