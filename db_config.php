<?php
// db_config.php
define('DB_FILE', 'serie_db.sqlite');

try {
    $pdo = new PDO('sqlite:' . DB_FILE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Verificar si existe la tabla "personajes"; si no existe, redireccionar al asistente de instalación
$tableExists = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='personajes'")->fetch();
if (!$tableExists) {
    header("Location: install.php");
    exit();
}
?>
