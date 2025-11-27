<?php
session_start();



require_once __DIR__ . '/config/BDD/db.php';

// Page demandée (par défaut : login)
$page = $_GET['page'] ?? 'homepage';

// Liste blanche des pages autorisées
$routes = [
    'homepage'     => 'public/pages/indexHomepage.php',
    'login'        => 'public/includes/user/login_logout/login.php',
    'register'     => 'public/includes/user/login_logout/register.php',
    'logout'       => 'public/includes/user/login_logout/logout.php',
    'dashboard'    => 'public/pages/indexDashboard.php',
    'events'       => 'public/pages/indexEvents.php',
    'alerts'       => 'public/pages/indexAlerts.php',
    'profile'      => 'public/pages/indexProfile.php',
    'admin'        => 'public/pages/indexAdmin.php',
    'shoppingCart' => 'public/includes/events/shoppingCart.php',
    'modifyPseudo' => 'public/includes/user/profil/modifyPseudo.php',

];

// Sécurité : page inexistante = erreur 404
if (!array_key_exists($page, $routes)) {
    http_response_code(404);
    echo "Page introuvable";
    exit;
}

// Pages accessibles uniquement si connecté
$privatePages = [
        'dashboard',
        'events',
        'alerts',
        'profile',
        'admin',
        'shoppingCart',


];

if (in_array($page, $privatePages) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?page=HomePage');
    exit;
}

// Pages accessibles uniquement par admin
$adminPages = ['admin'];

if (in_array($page, $adminPages)) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?page=dashboard');
        exit;
    }
}

require $routes[$page];

?>

<head>
    <link rel="stylesheet" href="/assets/styles/styles.css">
</head>
    