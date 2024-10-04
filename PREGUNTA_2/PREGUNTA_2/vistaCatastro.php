<?php
ob_start(); // Inicia el buffer de salida
session_start();
include 'header.php';
include 'bd.php';

// Obtener catastros del dueño logueado
$ci_dueño = $_SESSION['user_id'];
$sql = "SELECT * FROM catastro WHERE ci='$ci_dueño'";
$result = mysqli_query($con, $sql);
?>

<div class="container mt-5">
    <h2>Mis Catastros</h2>
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
                <th>Distrito</th>
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
                    <td><?php echo $row['distrito']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php ob_end_flush(); 