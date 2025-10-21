<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include 'db.php';

// Leer datos (pueden venir por POST o JSON)
$data = json_decode(file_get_contents("php://input"));

$username = isset($data->username) ? trim($data->username) : $_POST["username"] ?? "";
$password = isset($data->password) ? trim($data->password) : $_POST["password"] ?? "";

if (empty($username) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Faltan parámetros."]);
    exit;
}

$hashed = hash('sha256', $password);

// Verificar si ya existe
$check = $conn->prepare("SELECT id FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "El usuario ya existe."]);
    exit;
}

$check->close();

// Insertar usuario
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Usuario creado correctamente."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al crear usuario."]);
}

$stmt->close();
$conn->close();
?>
