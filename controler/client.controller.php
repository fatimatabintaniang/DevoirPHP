<?php
require_once "../model/model.php";

// Charger les données existantes
$data = jsonToArray();
$clients = $data["clients"];

/**
 * Valider les champs obligatoires
 */
function validateRequiredFields($fields) {
    foreach ($fields as $field => $value) {
        if (empty($value)) {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
            header("Location: " . WEBROOT . "?controller=client&page=client");
            exit;
        }
    }
}

/**
 * Vérifier l'unicité du téléphone
 */
function isPhoneUnique($clients, $telephone) {
    foreach ($clients as $client) {
        if ($client['telephone'] === $telephone) {
            $_SESSION['error'] = "Ce numéro de téléphone est déjà utilisé.";
            header("Location: " . WEBROOT . "?controller=client&page=client");
            exit;
        }
    }
}

/**
 * Ajouter un nouveau client
 */
function addClient($data, $nom, $telephone, $adresse) {
    $newClient = [
        "id" => count($data['clients']) + 1,
        "nom" => $nom,
        "telephone" => $telephone,
        "adresse" => $adresse,
        "dettes" => []
    ];
    $data['clients'][] = $newClient;
    return $data;
}

/**
 * Ajouter une dette à un client
 */
function addDette($data, $client_id, $montant, $date, $etat) {
    foreach ($data['clients'] as &$client) {
        if ($client['id'] === $client_id) {
            $newDette = [
                "id" => count($client['dettes']) + 1,
                "montant" => $montant,
                "date" => $date,
                "etat" => $etat,
                "articles" => []
            ];
            $client['dettes'][] = $newDette;
            break;
        }
    }
    return $data;
}

// Gestion des actions
if (isset($_GET['action']) && $_GET['action'] === 'addClient') {
    $nom = trim($_POST['nom']);
    $telephone = trim($_POST['telephone']);
    $adresse = trim($_POST['adresse']);

    // Validation des champs
    validateRequiredFields([
        'nom' => $nom,
        'telephone' => $telephone,
        'adresse' => $adresse
    ]);

    // Vérifier l'unicité du téléphone
    isPhoneUnique($data['clients'], $telephone);

    // Ajouter le nouveau client
    $data = addClient($data, $nom, $telephone, $adresse);

    // Sauvegarder dans le fichier JSON
    file_put_contents(__DIR__ . "/../bd/bd.json", json_encode($data, JSON_PRETTY_PRINT));

    // Redirection avec succès
    $_SESSION['success'] = "Client ajouté avec succès !";
    header("Location: " . WEBROOT . "?controller=client&page=client");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'addDette') {
    $client_id = intval($_POST['client_id']);
    $montant = floatval($_POST['montant']);
    $date = trim($_POST['date']);
    $etat = trim($_POST['etat']);

    // Validation des champs
    validateRequiredFields([
        'client_id' => $client_id,
        'montant' => $montant,
        'date' => $date,
        'etat' => $etat
    ]);

    // Ajouter la dette au client
    $data = addDette($data, $client_id, $montant, $date, $etat);

    // Sauvegarder dans le fichier JSON
    file_put_contents(__DIR__ . "/../bd/bd.json", json_encode($data, JSON_PRETTY_PRINT));

    // Redirection avec succès
    $_SESSION['success'] = "Dette ajoutée avec succès !";
    header("Location: " . WEBROOT . "?controller=client&page=client");
    exit;
}

// Gestion de l'ajout de client via POST (sans action spécifique)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $adresse = trim($_POST["adresse"]);

    // Validation des champs
    validateRequiredFields([
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse
    ]);

    // Vérifier l'unicité du prénom (si nécessaire)
    foreach ($clients as $client) {
        if ($client["prenom"] === $prenom) {
            $_SESSION['error'] = "Ce prénom est déjà utilisé.";
            header("Location: " . WEBROOT . "?controller=client&page=client");
            exit;
        }
    }

    // Ajouter le nouveau client
    $newClient = [
        "id" => count($clients) + 1,
        "nom" => $nom,
        "prenom" => $prenom,
        "adresse" => $adresse,
        "dettes" => []
    ];
    $data["clients"][] = $newClient;

    // Sauvegarder dans le fichier JSON
    file_put_contents(__DIR__ . "/../bd/bd.json", json_encode($data, JSON_PRETTY_PRINT));

    $_SESSION['success'] = "Client ajouté avec succès !";
    header("Location: " . WEBROOT . "?controller=client&page=client");
    exit;
}

// Charger la vue
require_once __DIR__ . "/../views/client.html.php";