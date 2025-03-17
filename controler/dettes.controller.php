<?php
require_once "../model/model.php";

// Charger les données existantes
$data = jsonToArray();
$clients = $data["clients"];

// Récupérer les paramètres de filtrage
$telephone = $_GET['telephone'] ?? '';
$date = $_GET['date'] ?? '';

// Filtrer les dettes non soldées
$dettes = [];
foreach ($clients as $client) {
    foreach ($client['dettes'] as $dette) {
        if ($dette['etat'] === 'Restant') {
            // Appliquer les filtres
            if ((empty($telephone) || $client['telephone'] === $telephone)) {
                if ((empty($date)) || $dette['date'] === $date) {
                    $dettes[] = [
                        'id' => $dette['id'],
                        'client_nom' => $client['nom'],
                        'montant' => $dette['montant'],
                        'date' => $dette['date'],
                        'etat' => $dette['etat']
                    ];
                }
            }
        }
    }
}

// Charger la vue
require_once __DIR__ . "/../views/dettes.html.php";