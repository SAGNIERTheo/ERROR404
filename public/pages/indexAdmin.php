<?php


?>


<div class="admin-wrapper">

    <nav class="admin-sidebar">
        <div class="admin-logo">ERROR 404</div>

        <ul class="admin-menu-list">
            <li class="admin-menu-item">
                <a href="#" class="admin-menu-link active">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Dashboard
                </a>
            </li>
            <li class="admin-menu-item">
                <a href="#" class="admin-menu-link">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Évènements
                </a>
            </li>
            <li class="admin-menu-item">
                <a href="#" class="admin-menu-link">
                    <svg class="admin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Messagerie
                </a>
            </li>
            <li class="admin-menu-item">
                <a href="#" class="admin-menu-link">
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
            <h1 class="admin-page-title">Dashboard</h1>
            <a href="#" class="admin-btn-add-event">
                <span>+</span> Ajouter un évènement
            </a>
        </div>

        <div class="admin-stats-grid">
            <div class="admin-stat-card">
                <div class="admin-stat-label">Adhérents Totaux</div>
                <span class="admin-stat-value">128</span>
                <a href="#" class="admin-stat-link">Voir les adhérents</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Paiement - Attente</div>
                <span class="admin-stat-value">189€</span>
                <a href="#" class="admin-stat-link">Paiement en attente (8)</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-label">Messagerie - Attente</div>
                <span class="admin-stat-value">17</span>
                <a href="#" class="admin-stat-link">Voir votre messagerie</a>
            </div>
        </div>

        <div class="admin-stat-card admin-stat-card-small">
            <div class="admin-stat-label">Évènements en cours</div>
            <span class="admin-stat-value">4</span>
            <a href="#" class="admin-stat-link">voir les évènements</a>
        </div>

        <div class="admin-hero">
            <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Bar Event" class="admin-hero-img">
            <div class="admin-hero-overlay"></div>
            <div class="admin-hero-content">
                <div class="admin-hero-label">Prochain évènement :</div>
                <div class="admin-hero-title">Bar la suite Vendredi 19/11/2025</div>
            </div>
        </div>

    </main>

</div>