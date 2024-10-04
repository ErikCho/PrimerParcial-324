<?php
ob_start();
session_start();
include 'header.php';
include 'bd.php'; // Asegúrate de que el archivo de conexión esté correcto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM persona WHERE ci = '$ci'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($contrasena, $user['contrasena'])) {
        // Autenticación exitosa
        $_SESSION['user_id'] = $user['ci'];
        $_SESSION['tipo_persona'] = $user['tipo_persona'];
        header("Location: index.php"); // Redirigir a la página de inicio
        exit();
    } else {
        $error = "CI o contraseña incorrectos.";
    }
}
?>

    <div class="container mt-5">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="card mb-3">
            <div class="card-body">
            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            </div>
            </div>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Volver Atrás</a>
    </div>
<?php include 'footer.php'; ?>
<?php ob_end_flush();