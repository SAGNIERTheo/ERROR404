<?php
// Récupération des événements à venir
$stmt = $pdo->query("SELECT * FROM event WHERE dateStart >= NOW() ORDER BY dateStart ASC");
$upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération de l'historique (événements passés)
$stmtHistory = $pdo->query("SELECT * FROM event WHERE dateStart < NOW() ORDER BY dateStart DESC");
$pastEvents = $stmtHistory->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="admin-wrapper">

    <nav class="admin-sidebar">
        <div class="admin-logo">ERROR 404</div>

        <ul class="admin-menu-list">
            <li class="admin-menu-item">
                <a href="?page=admin" class="admin-menu-link">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Dashboard
                </a>
            </li>
            <li class="admin-menu-item">
                <!-- Lien Actif -->
                <a href="?page=adminEvents" class="admin-menu-link active">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Évènements
                </a>
            </li>
            <li class="admin-menu-item">
                <a href="?page=adminMessages" class="admin-menu-link">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Messagerie
                </a>
            </li>
            <li class="admin-menu-item">
                <a href="?page=adminUsers" class="admin-menu-link">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Utilisateurs
                </a>
            </li>
        </ul>

        <div class="admin-sidebar-profile">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Axelle" class="admin-profile-pic">
            <div class="admin-profile-name">Axelle</div>
        </div>
    </nav>

    <main class="admin-main-content">
        <div class="admin-top-bar">
            <h2 class="admin-page-title">Gestion des évènements</h2>
            <a href="?page=addEventAdmin" class="admin-btn-add-event">
                <span>+</span> Ajouter un évènement
            </a>
        </div>
        
        <!-- SECTION 1 : PROCHAINS ÉVÉNEMENTS -->
        <h3 class="admin-section-title">
            Prochains évènements
            <span class="badge badge-upcoming"><?= count($upcomingEvents) ?></span>
        </h3>

        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Événement</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th style="text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($upcomingEvents)): ?>
                        <tr><td colspan="4" style="text-align:center; color:#999;">Aucun événement à venir</td></tr>
                    <?php else: ?>
                        <?php foreach($upcomingEvents as $evt): 
                            $date = new DateTime($evt['dateStart']);
                        ?>
                        <tr>
                            <td>
                                <div class="event-cell">
                                    <img src="<?= htmlspecialchars($evt['image']) ?>" alt="Img" class="event-thumb">
                                    <span class="event-name"><?= htmlspecialchars($evt['name']) ?></span>
                                </div>
                            </td>
                            <td><?= $date->format('d/m/Y H:i') ?></td>
                            <td><?= htmlspecialchars($evt['location'] ?? 'Non défini') ?></td>
                            <td style="text-align:right">
                                <a href="#" class="action-btn btn-edit">Modifier</a>
                                <a href="#" class="action-btn btn-delete">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- SECTION 2 : HISTORIQUE -->
        <h3 class="admin-section-title" style="margin-top: 50px;">
            Historique
            <span class="badge badge-past"><?= count($pastEvents) ?></span>
        </h3>

        <div class="admin-table-container" style="opacity: 0.8;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Événement</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th style="text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($pastEvents)): ?>
                        <tr><td colspan="4" style="text-align:center; color:#999;">Aucun historique</td></tr>
                    <?php else: ?>
                        <?php foreach($pastEvents as $evt): 
                            $date = new DateTime($evt['dateStart']);
                        ?>
                        <tr>
                            <td>
                                <div class="event-cell">
                                    <img src="<?= htmlspecialchars($evt['image']) ?>" alt="Img" class="event-thumb">
                                    <span class="event-name" style="color:#666"><?= htmlspecialchars($evt['name']) ?></span>
                                </div>
                            </td>
                            <td><?= $date->format('d/m/Y') ?></td>
                            <td><?= htmlspecialchars($evt['location'] ?? 'Non défini') ?></td>
                            <td style="text-align:right">
                                <a href="#" class="action-btn btn-delete">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</div>