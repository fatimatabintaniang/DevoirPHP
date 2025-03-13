<?php
session_start();
define("WEBROOT", "http://fatima.niang.ecole221.sn:8001"); // Correction de la constante

require_once "../model/model.php"; // Chemin absolu vers model.php

// Liste des contrôleurs disponibles
$controllers = [
    "client" => __DIR__ . "/../controler/client.controller.php"
];

$controller = $_GET['controller'] ?? 'client';
$page = $_GET['page'] ?? 'client';

// Vérifier si le contrôleur existe dans la liste
if (array_key_exists($controller, $controllers)) {
    require_once $controllers[$controller];
} else {
    die("Contrôleur non trouvé.");
}

if ($controller === 'client' && $page === 'client') {
    require_once __DIR__ . "/../views/client.html.php"; 
} else {
    echo "Page non trouvée.";
}