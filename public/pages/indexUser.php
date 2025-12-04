<?php
    // Inclusion de la navigation
    include_once './public/includes/nav.php';
?>


<section class="app-container">

    <!-- Petit header de navigation -->
    <div class="header-nav">
        <a href="?page=profile" class="link-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            Profil
        </a>
    </div>

    <h2 class="page-title">Modifier votre profil</h2>

    <div class="settings-list">
        
        <!-- PSEUDO -->
        <div class="settings-item">
            <div class="settings-info">
                <span class="settings-label">Pseudo</span>
                <span class="settings-value"><?= htmlspecialchars($_SESSION['pseudo'] ?? '') ?></span>
            </div>
            <a href="?page=modifyPseudo" class="btn-edit-small">Modifier</a>
        </div>

        <!-- EMAIL -->
        <div class="settings-item">
            <div class="settings-info">
                <span class="settings-label">Adresse Email</span>
                <span class="settings-value"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></span>
            </div>
            <a href="?page=modifyEmail" class="btn-edit-small">Modifier</a>
        </div>

        <!-- PRÉNOM -->
        <div class="settings-item">
            <div class="settings-info">
                <span class="settings-label">Prénom</span>
                <span class="settings-value"><?= htmlspecialchars($_SESSION['firstName'] ?? '') ?></span>
            </div>
            <a href="?page=modifyFirstName" class="btn-edit-small">Modifier</a>
        </div>

        <!-- NOM -->
        <div class="settings-item">
            <div class="settings-info">
                <span class="settings-label">Nom</span>
                <span class="settings-value"><?= htmlspecialchars($_SESSION['name'] ?? '') ?></span>
            </div>
            <a href="?page=modifyName" class="btn-edit-small">Modifier</a>
        </div>

    </div>

    <!-- SÉCURITÉ -->
    <div class="security-section">
        <a href="?page=modifyPwd" class="btn-password">
            🔒 Modifier le mot de passe
        </a>
    </div>

    <!-- Cale invisible pour la nav -->
    <div class="bottom-spacer"></div>

</section>