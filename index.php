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
    'modifyProfil'    => 'public/pages/indexUser.php',
    'detailEvent'     => 'public/pages/detailEvent.php',
    'adminEvents'     => 'public/pages/indexEventAdmin.php',
    'adminMessages'   => 'public/pages/indexMessageAdmin.php',
    'adminUsers'      => 'public/pages/indexUserAdmin.php',
    'addEventAdmin'   => 'public/pages/addEventAdmin.php',
    'editEventAdmin'  => 'public/pages/editEventAdmin.php',
    'deleteEventAdmin' => 'public/includes/admin/deleteEventAdmin.php',
    'deleteUserAdmin' => 'public/includes/admin/deleteUserAdmin.php',

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
        'modifyProfil',
        'detailEvent',
        'adminEvents',
        'adminMessages',
        'adminUsers',
        'addEventAdmin',
        'editEventAdmin',
        'deleteEventAdmin',

];

if (in_array($page, $privatePages) && !isset($_SESSION['id'])) {
    header('Location: ?page=homepage');
    exit;
}




// Pages accessibles uniquement par admin
$adminPages = ['admin', 'adminEvents', 'adminMessages', 'adminUsers', 'addEventAdmin', 'editEventAdmin', 'deleteEventAdmin'];

if (in_array($page, $adminPages)) {
    if (!isset($_SESSION['id']) || $_SESSION['roles'] !== 'admin') {
        header('Location: ?page=dashboard');
        exit;
    }
}



// chargement du style avant chargement des pages
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR404</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/dashboardStyle.css">
    <link rel="stylesheet" href="./assets/styles/adminStyle.css">
    <link rel="stylesheet" href="./assets/styles/loginStyle.css">
    <link rel="stylesheet" href="./assets/styles/registerStyle.css">

</head>


    <link rel="stylesheet" href="./assets/styles/alertStyle.css">

</head>
<body>
    <?php
    include_once $routes[$page];
    ?>
</body>
    
