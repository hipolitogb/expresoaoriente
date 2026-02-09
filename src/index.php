<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expreso a Oriente - Test</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .status { padding: 10px; border-radius: 4px; margin: 10px 0; }
        .ok { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>Expreso a Oriente</h1>
    <h3>Estado del servidor</h3>

    <div class="status ok">PHP <?= phpversion() ?> funcionando</div>
    <div class="status ok">Apache funcionando</div>

    <?php
    $conn = @new mysqli('db', 'expreso', 'expreso123', 'expresoaoriente');
    if ($conn->connect_error) {
        echo '<div class="status error">MySQL: ' . htmlspecialchars($conn->connect_error) . '</div>';
    } else {
        echo '<div class="status ok">MySQL conectado correctamente</div>';
        $conn->close();
    }
    ?>

    <p><a href="/phpinfo.php">Ver phpinfo()</a></p>
</body>
</html>
