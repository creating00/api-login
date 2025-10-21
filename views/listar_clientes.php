<?php
include '../db.php';
$result = $conn->query("SELECT id, username, created_at, activo FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Clientes Activos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script>
    async function cambiarEstado(id, nuevoEstado) {
      if (!confirm('¿Seguro que querés cambiar el estado de este usuario?')) return;

      const data = { id: id, activo: nuevoEstado };
      const response = await fetch('../cambiar_estado.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });

      const result = await response.json();
      alert(result.message);
      location.reload();
    }
  </script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Panel Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="registrar_cliente.php">Registrar</a></li>
        <li class="nav-item"><a class="nav-link active" href="listar_clientes.php">Ver Clientes</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <span>Clientes Registrados</span>
      <a href="registrar_cliente.php" class="btn btn-light btn-sm">+ Nuevo Cliente</a>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha de registro</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['created_at']) ?></td>
            <td>
              <?php if ($row['activo']): ?>
                <span class="badge bg-success">Activo</span>
              <?php else: ?>
                <span class="badge bg-danger">Inactivo</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($row['activo']): ?>
                <button class="btn btn-warning btn-sm" onclick="cambiarEstado(<?= $row['id'] ?>, 0)">Desactivar</button>
              <?php else: ?>
                <button class="btn btn-success btn-sm" onclick="cambiarEstado(<?= $row['id'] ?>, 1)">Activar</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
