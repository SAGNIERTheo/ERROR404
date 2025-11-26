<?php
session_start();

require_once __DIR__ . '/../../../config/BDD/db.php';

session_destroy();

header('Location: http://localhost:8000/?=login');
exit;