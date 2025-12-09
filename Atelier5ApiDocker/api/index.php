<?php

header('Content-Type: application/json');

// --- 1. Configuration de la Base de Données (Lecture depuis les variables d'environnement) ---
// Note : Le service PHP reçoit ces variables via 'env_file' dans docker-compose.yml
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');

if (empty($db_host) || empty($db_user) || empty($db_name)) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de configuration : les variables d\'environnement DB ne sont pas définies.']);
    exit;
}

// --- 2. Récupération et Validation des Paramètres (Le reste du code reste inchangé) ---
$ville = $_GET['ville'] ?? null;
$date_req = $_GET['date'] ?? date('Y-m-d'); 

if (empty($ville)) {
    http_response_code(400);
    echo json_encode(['error' => 'Le paramètre "ville" est obligatoire.']);
    exit;
}

$safe_ville = htmlspecialchars($ville);
$safe_date = htmlspecialchars($date_req);

// --- 3. Connexion à la Base de Données ---
// Utilisation des variables lues du fichier .env
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $conn->connect_error]);
    exit;
}

// --- 4. Requête Préparée ---
$stmt = $conn->prepare("SELECT meteo FROM meteo WHERE ville = ? AND date = ?");
$stmt->bind_param("ss", $safe_ville, $safe_date);
$stmt->execute();
$result = $stmt->get_result();

// --- 5. Traitement des Résultats ---
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = [
        'ville' => $safe_ville,
        'date' => $safe_date,
        'meteo' => $row['meteo']
    ];
    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(['error' => "Météo non trouvée pour la ville '$safe_ville' à la date '$safe_date'."]);
}

// --- 6. Fermeture des Connexions ---
$stmt->close();
$conn->close();

?>