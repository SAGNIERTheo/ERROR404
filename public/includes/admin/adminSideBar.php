<?php
// On récupère la page actuelle pour savoir quel lien allumer
$currentPage = $_GET['page'] ?? 'admin';

// Récupération du prénom de la session (ou 'Admin' par défaut si non défini)
$adminName = $_SESSION['firstName'] ?? 'Admin';
// Récupération de la première lettre en majuscule
$adminInitial = strtoupper(substr($adminName, 0, 1));
?>

<nav class="admin-sidebar">
    <div class="admin-logo">
        <img src="./assets/images/logo1.jpg" alt="Logo de l'association étudiante 'ERROR404'">
    </div>

    <ul class="admin-menu-list">
        
        <!-- LIEN DASHBOARD -->
        <li class="admin-menu-item">
            <a href="?page=admin" class="admin-menu-link <?= $currentPage === 'admin' ? 'active' : '' ?>">
                <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a>
        </li>

        <!-- LIEN ÉVÈNEMENTS -->
        <li class="admin-menu-item">
            <?php 
                $activeEvents = in_array($currentPage, ['adminEvents', 'addEventAdmin', 'editEventAdmin', 'deleteEventAdmin']) ? 'active' : ''; 
            ?>
            <a href="?page=adminEvents" class="admin-menu-link <?= $activeEvents ?>">
                <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Évènements
            </a>
        </li>

        <!-- LIEN MESSAGERIE -->
        <li class="admin-menu-item">
            <a href="?page=adminMessages" class="admin-menu-link <?= $currentPage === 'adminMessages' ? 'active' : '' ?>">
                <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Messagerie
            </a>
        </li>

        <!-- LIEN UTILISATEURS -->
        <li class="admin-menu-item">
            <a href="?page=adminUsers" class="admin-menu-link <?= $currentPage === 'adminUsers' ? 'active' : '' ?>">
                <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Utilisateurs
            </a>
        </li>
    </ul>

    <div class="returnApp">
        <a href="?page=dashboard">
            Retourner à l'application
        </a>
    </div>

    <div class="admin-sidebar-profile">
        <!-- Remplacement de l'image par une div contenant l'initiale -->
        <div class="admin-profile-initials">
            <?= $adminInitial ?>
        </div>
        <!-- Affichage dynamique du prénom -->
        <div class="admin-profile-name"><?= htmlspecialchars($adminName) ?></div>
    </div>
</nav>