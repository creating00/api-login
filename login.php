<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username) || !isset($data->password)) {
    echo json_encode(["status" => "error", "message" => "Faltan parámetros."]);
    exit;
}

$username = $conn->real_escape_string($data->username);
$password = hash('sha256', $data->password);

$query = $conn->prepare("SELECT id, username FROM users WHERE username = ? AND password = ? AND activo = 1");
$query->bind_param("ss", $username, $password);
$query->execute();
$result = $query->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode([
        "status" => "success",
        "message" => "Login exitoso.",
        "user" => $user
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Usuario o contraseña incorrectos, o usuario inactivo."]);
}

$conn->close();
?>
