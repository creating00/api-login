<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"]) || !isset($data["activo"])) {
    echo json_encode(["status" => "error", "message" => "Faltan parámetros."]);
    exit;
}

$id = intval($data["id"]);
$activo = intval($data["activo"]);

$stmt = $conn->prepare("UPDATE users SET activo = ? WHERE id = ?");
$stmt->bind_param("ii", $activo, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Estado actualizado correctamente."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar estado."]);
}

$stmt->close();
$conn->close();
?>
