<?php
session_start();
include 'header.php';
include 'bd.php';

// Funcionalidad para agregar un nuevo registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $zona = $_POST['zona'];
    $x_inicio = $_POST['x_inicio'];
    $y_inicio = $_POST['y_inicio'];
    $x_fin = $_POST['x_fin'];
    $y_fin = $_POST['y_fin'];
    $superficie = $_POST['superficie'];
    $ci = $_POST['ci'];
    $distrito = $_POST['distrito'];

    $sql = "INSERT INTO catastro (zona, x_inicio, y_inicio, x_fin, y_fin, superficie, ci, distrito) VALUES ('$zona', '$x_inicio', '$y_inicio', '$x_fin', '$y_fin', '$superficie', '$ci', '$distrito')";
    mysqli_query($con, $sql);
}

// Funcionalidad para eliminar un registro
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM catastro WHERE id='$id'";
    mysqli_query($con, $sql);
}

// Obtener todos los registros
$sql = "SELECT * FROM catastro";
$result = mysqli_query($con, $sql);
?>

<div class="container mt-5">
    <h2>Gestión de Catastro</h2>

    <h4>Registrar Nuevo Catastro</h4>
    <div class="card mb-3">
    <div class="card-body">
    <form method="post">
        <div class="form-group">
            <label>Zona</label>
            <input type="text" name="zona" class="form-control" required>
        </div>
        <div class="form-group">
            <label>X Inicio</label>
            <input type="number" step="0.000001" name="x_inicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Y Inicio</label>
            <input type="number" step="0.000001" name="y_inicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label>X Fin</label>
            <input type="number" step="0.000001" name="x_fin" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Y Fin</label>
            <input type="number" step="0.000001" name="y_fin" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Superficie</label>
            <input type="number" step="0.01" name="superficie" class="form-control" required>
        </div>
        <div class="form-group">
            <label>CI Dueño</label>
            <input type="text" name="ci" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Distrito</label>
            <input type="text" name="distrito" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-success">Registrar</button>
    </form>
    </div>
    </div>

    <h4 class="mt-5">Catastros Registrados</h4>
    <div class="card mb-3">
    <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Zona</th>
                <th>X Inicio</th>
                <th>Y Inicio</th>
                <th>X Fin</th>
                <th>Y Fin</th>
                <th>Superficie</th>
                <th>CI Dueño</th>
                <th>Distrito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['zona']; ?></td>
                    <td><?php echo $row['x_inicio']; ?></td>
                    <td><?php echo $row['y_inicio']; ?></td>
                    <td><?php echo $row['x_fin']; ?></td>
                    <td><?php echo $row['y_fin']; ?></td>
                    <td><?php echo $row['superficie']; ?></td>
                    <td><?php echo $row['ci']; ?></td>
                    <td><?php echo $row['distrito']; ?></td>
                    <td>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        <a href="editarCatastro.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    </div>
</div>

<?php include 'footer.php'; ?>