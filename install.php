<?php
// install.php
define('DB_FILE', 'serie_db.sqlite');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo = new PDO('sqlite:' . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $createTable = "CREATE TABLE IF NOT EXISTS personajes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre VARCHAR(100) NOT NULL,
            color VARCHAR(50) NOT NULL,
            tipo VARCHAR(50) NOT NULL,
            nivel INTEGER NOT NULL,
            foto VARCHAR(255)
        )";
        $pdo->exec($createTable);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Error al crear la base de datos: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Instalación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="mt-5">Asistente de Configuración de Base de Datos</h2>
    <form method="post" class="mt-4">
        <p>Presione el botón para crear la base de datos y la tabla de personajes.</p>
        <button type="submit" class="btn btn-primary">Instalar</button>
    </form>
</body>
</html>
