<?php
// download_pdf.php
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

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->setPaper('A4', 'portrait');

$html = '<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
    .container { text-align: center; }
    .profile { background: #fff; border: 1px solid #ccc; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .profile img { max-width: 100%; height: auto; border-radius: 4px; margin-bottom: 20px; }
    .profile h2 { margin-bottom: 10px; color: #333; }
    .profile p { margin: 5px 0; color: #555; }
  </style>
</head>
<body>
<div class="container">
  <div class="profile">';
if ($personaje['foto'] && file_exists($personaje['foto'])) {
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $personaje['foto']);
        finfo_close($finfo);
    } elseif (function_exists('getimagesize')) {
        $imgInfo = getimagesize($personaje['foto']);
        $mimeType = $imgInfo['mime'];
    } else {
        $mimeType = 'image/jpeg';
    }
    $imgData = base64_encode(file_get_contents($personaje['foto']));
    $src = 'data:' . $mimeType . ';base64,' . $imgData;
    $html .= '<img src="' . $src . '" alt="Foto">';
}
$html .= '<h2>' . htmlspecialchars($personaje['nombre']) . '</h2>
    <p><strong>Color Representativo:</strong> ' . htmlspecialchars($personaje['color']) . '</p>
    <p><strong>Tipo:</strong> ' . htmlspecialchars($personaje['tipo']) . '</p>
    <p><strong>Nivel:</strong> ' . htmlspecialchars($personaje['nivel']) . '</p>
  </div>
</div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('perfil_' . $personaje['id'] . '.pdf', ['Attachment' => false]);
?>
