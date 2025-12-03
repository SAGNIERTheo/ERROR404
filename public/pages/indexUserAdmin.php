<?php
// Récupération de tous les utilisateurs AVEC le nom de leur promo
// On utilise u.* pour tout user et p.name pour le nom de la promo
$sql = "SELECT u.*, p.name AS promo_name 
        FROM user u 
        LEFT JOIN promo p ON u.promo_id = p.id 
        ORDER BY u.id DESC";

$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* CSS LOCAL SPÉCIFIQUE */
    /* Les styles globaux sont dans adminStyle.css */

    .user-avatar-small {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #ddd;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #555;
        margin-right: 10px;
        font-size: 14px;
    }

    /* Couleurs spécifiques aux badges rôles */
    .role-admin { background-color: #FEE2E2; color: #DC2626; } /* Rouge */
    .role-user { background-color: #EFF6FF; color: #1D4ED8; }  /* Bleu */
    
    /* Couleur spécifique badge promo (Gris) */
    .badge-promo { background-color: #F3F4F6; color: #4B5563; font-weight: 600; }
</style>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <?php include 'public/includes/admin/adminSideBar.php'; ?>

    <main class="admin-main-content">
        <div class="admin-top-bar">
            <h2 class="admin-page-title">Gestion des Utilisateurs</h2>
        </div>
        
        <h3 class="admin-section-title">
            Liste des inscrits (<?= count($users) ?>)
        </h3>

        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Promo</th> <!-- ✅ Nouvelle colonne -->
                        <th>Rôle</th>
                        <th style="text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr><td colspan="5" style="text-align:center; color:#999; padding:30px;">Aucun utilisateur trouvé</td></tr>
                    <?php else: ?>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center;">
                                    <!-- Avatar avec la première lettre du pseudo -->
                                    <div class="user-avatar-small">
                                        <?= strtoupper(substr($user['pseudo'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div style="font-weight:600;"><?= htmlspecialchars($user['pseudo']) ?></div>
                                        <div style="font-size:12px; color:#888;">
                                            <?= htmlspecialchars($user['firstName'] . ' ' . $user['name']) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            

                            <td>
                                <?php if(!empty($user['promo_name'])): ?>
                                    <span class="badge badge-promo"><?= htmlspecialchars($user['promo_name']) ?></span>
                                <?php else: ?>
                                    <span style="color:#ccc; font-size:12px;">Sans promo</span>
                                <?php endif; ?>
                            </td>


                            <td>

                                <?php if($user['roles_id'] == 1): ?>
                                    <span class="badge role-admin">Admin</span>
                                <?php else: ?>
                                    <span class="badge role-user">User</span>
                                <?php endif; ?>
                            </td>

                            <td style="text-align:right">
                                <?php if($user['id'] != $_SESSION['id']): ?>
                                    <a href="?page=deleteUserAdmin&id=<?= $user['id'] ?>" 
                                       class="action-btn btn-delete"
                                       onclick="return confirm('Attention : supprimer cet utilisateur est définitif. Confirmer ?');">
                                       Supprimer
                                    </a>
                                <?php else: ?>
                                    <span style="font-size:12px; color:#999;">(Vous)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</div>