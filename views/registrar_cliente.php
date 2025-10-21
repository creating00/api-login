<?php
// Opcional: mostrar mensajes tras registrar
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        "username" => $_POST["username"],
        "password" => $_POST["password"]
    ];

    $ch = curl_init("../https://api-login.creatingsoft.net/register.php"); // Ajustá la URL según tu servidor
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    $mensaje = $result["message"] ?? "Error al registrar.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Cliente</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Panel Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="registrar_cliente.php">Registrar</a></li>
        <li class="nav-item"><a class="nav-link" href="listar_clientes.php">Ver Clientes</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">Registrar Cliente</div>
    <div class="card-body">
      <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Nombre de usuario</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="listar_clientes.php" class="btn btn-secondary">Ver clientes</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
