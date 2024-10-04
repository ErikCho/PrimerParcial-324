<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['user_id']; ?></h2>
    <p>Tipo de Usuario: <?php echo $_SESSION['tipo_persona']; ?></p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>