<?php
session_start();

// Page demandée (par défaut : login)
$page = $_GET['page'] ?? 'login';

// Liste blanche des pages autorisées
$routes = [
    'login'        => 'pages/login.php',
    'register'     => 'pages/register.php',
    'dashboard'    => 'pages/dashboard.php',
    'events'       => 'pages/events.php',
    'alerts'       => 'pages/alerts.php',
    'profile'      => 'pages/profile.php',
    'admin-events' => 'pages/admin_events.php',
    'logout'       => 'pages/logout.php',
];

// Sécurité : page inexistante = erreur 404
if (!array_key_exists($page, $routes)) {
    http_response_code(404);
    echo "Page introuvable";
    exit;
}

// Pages accessibles uniquement si connecté
$privatePages = ['dashboard', 'events', 'alerts', 'profile', 'admin-events'];

if (in_array($page, $privatePages) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

// Pages accessibles uniquement par admin
$adminPages = ['admin-events'];

if (in_array($page, $adminPages)) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?page=dashboard');
        exit;
    }
}

require $routes[$page];