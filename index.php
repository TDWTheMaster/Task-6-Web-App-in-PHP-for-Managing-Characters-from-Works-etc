<?php
// index.php
require 'db_config.php';
$query = $pdo->query("SELECT * FROM personajes ORDER BY id DESC");
$personajes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Personajes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body { padding-top: 20px; }
        .navbar { margin-bottom: 20px; }
        table img { width: 50px; height: auto; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Personajes VR</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="add.php">Agregar Personaje</a></li>
    </ul>
  </div>
</nav>
<div class="container">
    <h2 class="mb-4">Lista de Personajes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Tipo</th>
                <th>Nivel</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personajes as $p): ?>
            <tr>
                <td>
                    <?php if($p['foto'] && file_exists($p['foto'])): ?>
                        <img src="<?php echo $p['foto']; ?>" alt="Foto">
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                <td><?php echo htmlspecialchars($p['color']); ?></td>
                <td><?php echo htmlspecialchars($p['tipo']); ?></td>
                <td><?php echo htmlspecialchars($p['nivel']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="delete.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este personaje?')">Eliminar</a>
                    <a href="download_pdf.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-info" target="_blank">Descargar PDF</a>
            </tr>
            <?php endforeach; ?>
            <?php if(empty($personajes)): ?>
            <tr>
                <td colspan="6" class="text-center">No hay personajes registrados.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
