<?php
session_start();
include 'header.php';
include 'bd.php';

// Inicializar variables
$error = null;

// Cargar macrodistritos
$macrodistritos = [];
try {
    $stmt = $con->query("SELECT id, nombre FROM macrodistritos");
    $macrodistritos = $stmt->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    $error = "Error al cargar macrodistritos: " . $e->getMessage();
}

// Manejo del envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $contrasena = $_POST['contrasena'];
    $zona_id = intval($_POST['zona']);

    $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO persona (ci, nombre, paterno, materno, tipo_persona, contrasena, zona_id) VALUES (?, ?, ?, ?, 'dueño', ?, ?)");
    $stmt->bind_param("sssss", $ci, $nombre, $paterno, $materno, $contrasena_hashed, $zona_id);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $ci;
        $_SESSION['tipo_persona'] = 'dueño';
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al registrar el dueño: " . $stmt->error;
    }

    $stmt->close();
}
?>

<div class="container mt-5">
    <h2>Registro de Dueños</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="card mb-3">
    <div class="card-body">
    <form method="post">
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
        <div class="form-group">
            <label>Macrodistrito</label>
            <select id="macrodistrito" class="form-control" required>
                <option value="">Seleccione Macrodistrito</option>
                <?php foreach ($macrodistritos as $macrodistrito): ?>
                    <option value="<?php echo $macrodistrito['id']; ?>"><?php echo $macrodistrito['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Zona</label>
            <select id="zona" class="form-control" required>
                <option value="">Seleccione Zona</option>
            </select>
        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Cargar zonas al seleccionar macrodistrito
    $('#macrodistrito').change(function() {
        var macrodistrito_id = $(this).val();
        // Limpiar el combo de zonas
        $('#zona').html('<option value="">Seleccione Zona</option>');

        if (macrodistrito_id) {
            $.ajax({
                url: 'get_zonas.php',
                type: 'GET',
                data: { macrodistrito_id: macrodistrito_id },
                dataType: 'json',
                success: function(data) {
                    // Agregar las zonas correspondientes
                    $.each(data, function(index, zona) {
                        $('#zona').append('<option value="' + zona.id + '">' + zona.nombre + '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al cargar las zonas:', textStatus, errorThrown);
                    alert('Error al cargar las zonas. Revisa la consola para más detalles.');
                }
            });
        }
    });
});
</script>

<?php include 'footer.php'; ?>