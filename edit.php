<?php
// edit.php
require 'db_config.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM personajes WHERE id = ?");
$stmt->execute([$id]);
$personaje = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$personaje) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $tipo = $_POST['tipo'];
    $nivel = $_POST['nivel'];
    $foto = $personaje['foto'];

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

    $stmt = $pdo->prepare("UPDATE personajes SET nombre=?, color=?, tipo=?, nivel=?, foto=? WHERE id=?");
    $stmt->execute([$nombre, $color, $tipo, $nivel, $foto, $id]);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Personaje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>body { padding-top: 20px; }</style>
</head>
<body>
<div class="container">
    <h2>Editar Personaje</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($personaje['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label>Color Representativo</label>
            <input type="text" name="color" class="form-control" value="<?php echo htmlspecialchars($personaje['color']); ?>" required>
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" value="<?php echo htmlspecialchars($personaje['tipo']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nivel</label>
            <input type="number" name="nivel" class="form-control" value="<?php echo htmlspecialchars($personaje['nivel']); ?>" required>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <?php if($personaje['foto'] && file_exists($personaje['foto'])): ?>
                <img src="<?php echo $personaje['foto']; ?>" alt="Foto" style="width:100px;"><br>
            <?php endif; ?>
            <input type="file" name="foto" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
