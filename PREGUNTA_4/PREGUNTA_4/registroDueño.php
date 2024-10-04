<?php
ob_start(); // Inicia el buffer de salida
session_start();
include 'header.php';
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $contrasena = $_POST['contrasena'];

    $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

    $sql = "INSERT INTO persona (ci, nombre, paterno, materno, tipo_persona, contrasena) VALUES ('$ci', '$nombre', '$paterno', '$materno', 'dueño', '$contrasena_hashed')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['user_id'] = $ci;
        $_SESSION['tipo_persona'] = 'dueño';
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al registrar el dueño: " . mysqli_error($con);
    }
}
?>

<div class="container mt-5">
    <h2>Registro de Dueños</h2>
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
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Apellido Paterno</label>
            <input type="text" name="paterno" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Apellido Materno</label>
            <input type="text" name="materno" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>

<?php include 'footer.php'; ?>
<?php ob_end_flush(); 