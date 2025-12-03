<?php
// Récupération des événements à venir
$stmt = $pdo->query("SELECT * FROM event WHERE dateStart >= NOW() ORDER BY dateStart ASC");
$upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération de l'historique (événements passés)
$stmtHistory = $pdo->query("SELECT * FROM event WHERE dateStart < NOW() ORDER BY dateStart DESC");
$pastEvents = $stmtHistory->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="admin-wrapper">

<?php include 'public/includes/admin/adminSideBar.php'; ?>

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
                            <td><?= htmlspecialchars($evt['place'] ?? 'Non défini') ?></td>
                            <td style="text-align:right">
                                <!-- LIEN MODIFIER -->
                                <a href="?page=editEventAdmin&id=<?= $evt['id'] ?>" class="action-btn btn-edit">Modifier</a>
                                
                                <!-- LIEN SUPPRIMER (Avec confirmation) -->
                                <a href="?page=deleteEventAdmin&id=<?= $evt['id'] ?>" 
                                   class="action-btn btn-delete"
                                   onclick="return confirm('Es-tu sûr de vouloir supprimer cet événement ? Cette action est irréversible.');">
                                   Supprimer
                                </a>
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
                            <td><?= htmlspecialchars($evt['place'] ?? 'Non défini') ?></td>
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