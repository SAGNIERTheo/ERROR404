<?php
session_start();



require_once __DIR__ . '/config/BDD/db.php';

// Page par défaut : Homepage
$page = $_GET['page'] ?? 'homepage';

// Liste blanche des pages autorisées
$routes = [
    'homepage'        => 'public/pages/indexHomepage.php',
    'login'           => 'public/includes/user/login_logout/login.php',
    'register'        => 'public/includes/user/login_logout/register.php',
    'logout'          => 'public/includes/user/login_logout/logout.php',
    'dashboard'       => 'public/pages/indexDashboard.php',
    'events'          => 'public/pages/indexEvents.php',
    'alerts'          => 'public/pages/indexAlerts.php',
    'profile'         => 'public/pages/indexProfile.php',
    'admin'           => 'public/pages/indexAdmin.php',
    'shoppingCart'    => 'public/includes/events/shoppingCart.php',
    'modifyPseudo'    => 'public/includes/user/profil/modifyPseudo.php',
    'modifyEmail'     => 'public/includes/user/profil/modifyEmail.php',
    'modifyName'      => 'public/includes/user/profil/modifyName.php',
    'modifyFirstName' => 'public/includes/user/profil/modifyFirstName.php',
    'modifyPwd'       => 'public/includes/user/profil/modifyPwd.php',
    'modifyProfil'    => 'public/pages/indexUser.php'

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
        'modifyFirstName',
        'modifyEmail',
        'modifyName',
        'modifyFirstName',
        'modifyPwd',

];

if (in_array($page, $privatePages) && !isset($_SESSION['id'])) {
    header('Location: ?page=homepage');
    exit;
}

// Pages accessibles uniquement par admin
$adminPages = ['admin'];

if (in_array($page, $adminPages)) {
    if (!isset($_SESSION['id']) || $_SESSION['roles'] !== 'admin') {
        header('Location: ?page=admin');
        exit;
    }
}

require $routes[$page];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles/styles.css">
    <link rel="stylesheet" href="/assets/styles/dashboardStyle.css">
</head>

<!-- Mettre en place un title Head dynamique avec js (voir doc internet) 
<head>
    <title>Dashboard</title>
</head>

-->
    