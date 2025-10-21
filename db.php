<?php
$host = "localhost";
$user = "u383024755_apilogin";
$pass = "System32&";
$db   = "u383024755_apilogin";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Error de conexión a la base de datos."]));
}
?>
