<?php

// Charger les données existantes
$data = jsonToArray();
$clients = $data["clients"];

// Vérifier si la requête est bien POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $prenom= trim($_POST["prenom"]);
    $adresse = trim($_POST["adresse"]);

    // Vérifier que tous les champs sont remplis
    if (empty($nom) || empty($prenom) || empty($adresse)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: " . WEBROOT . "?controller=client&page=client");
        exit;
    }

    // Vérifier l'unicité du téléphone
    foreach ($clients as $client) {
        if ($client["prenom"] === $prenom) {
            $_SESSION['error'] = "Ce numéro de téléphone est déjà utilisé.";
            header("Location: " . WEBROOT . "?controller=client&page=client");
            exit;
        }
    }

    // Générer un nouvel ID
    $newId = count($clients) + 1;

    // Ajouter le nouveau client
    $newClient = [
        "id" => $newId,
        "nom" => $nom,
        "prenom" => $prenom,
        "adresse" => $adresse,
        "dettes" => [] // Liste vide au départ
    ];

    $data["clients"][] = $newClient;

    // Sauvegarder dans le fichier JSON
    file_put_contents(__DIR__ . "/../bd/bd.json", json_encode($data, JSON_PRETTY_PRINT));

    $_SESSION['success'] = "Client ajouté avec succès !";
    header("Location: " . WEBROOT . "?controller=client&page=client");
    exit;
}

require_once __DIR__ . "/../views/client.html.php";