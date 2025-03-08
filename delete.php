<?php
// delete.php
require 'db_config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM personajes WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: index.php");
exit();
?>
