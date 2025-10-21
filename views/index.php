<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Panel Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="registrar_cliente.php">Registrar Cliente</a></li>
        <li class="nav-item"><a class="nav-link" href="listar_clientes.php">Ver Clientes</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 text-center">
  <div class="card shadow p-4">
    <h2 class="mb-4 text-primary">Bienvenido al Panel de Administración</h2>
    <p>Usá las opciones del menú para gestionar tus clientes.</p>

    <div class="mt-4">
      <a href="registrar_cliente.php" class="btn btn-success btn-lg me-2">➕ Registrar Cliente</a>
      <a href="listar_clientes.php" class="btn btn-outline-primary btn-lg">👥 Ver Clientes</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
