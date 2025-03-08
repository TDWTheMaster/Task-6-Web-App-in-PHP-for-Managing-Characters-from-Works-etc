<?php
// add.php
require 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $tipo = $_POST['tipo'];
    $nivel = $_POST['nivel'];
    $foto = '';

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $uploads_dir = 'uploads';
        if(!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0755, true);
        }
        $filename = time() . '_' . basename($_FILES['foto']['name']);
        $destination = $uploads_dir . '/' . $filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], $destination);
        $foto = $destination;
    }

    $stmt = $pdo->prepare("INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $color, $tipo, $nivel, $foto]);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Personaje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>body { padding-top: 20px; }</style>
</head>
<body>
<div class="container">
    <h2>Agregar Nuevo Personaje</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Color Representativo</label>
            <input type="text" name="color" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nivel</label>
            <input type="number" name="nivel" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
