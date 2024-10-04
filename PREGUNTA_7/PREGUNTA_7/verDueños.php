<?php
session_start();
include 'header.php';
include 'bd.php';

// Obtener la lista de personas de tipo 'dueño' con el tipo de impuesto
$sql = "SELECT p.ci, p.nombre, p.paterno, p.materno, c.id AS codigo_catastral,
               CASE 
                   WHEN c.id LIKE '1%' THEN 'Alto' 
                   WHEN c.id LIKE '2%' THEN 'Medio' 
                   WHEN c.id LIKE '3%' THEN 'Bajo' 
                   ELSE 'No Definido' 
               END AS tipo_impuesto
        FROM persona p
        LEFT JOIN catastro c ON p.ci = c.ci
        WHERE p.tipo_persona = 'dueño'";

$result = mysqli_query($con, $sql);

if (!$result) {
    echo "Error en la consulta: " . mysqli_error($con);
    exit;
}

// Función para pivoteo y evitar duplicados
function pivot($result) {
    $personas = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $tipo_impuesto = $row['tipo_impuesto'];
        $ci = $row['ci'];

        // Verificar si el CI ya ha sido agregado
        if (!isset($personas[$ci])) {
            $personas[$ci] = [
                'nombre' => $row['nombre'],
                'paterno' => $row['paterno'],
                'materno' => $row['materno'],
                'codigos_catastrales' => [],
                'tipo_impuesto' => $tipo_impuesto
            ];
        }
        
        // Agregar el código catastral al array
        $personas[$ci]['codigos_catastrales'][] = $row['codigo_catastral'];
    }
    return $personas;
}

// Llamar a la función pivot
$personas = pivot($result);

// Determinar si se está en modo de tabla convertida
$isConverted = isset($_POST['convertir']) && $_POST['convertir'] === '1';
?>

<div class="container mt-5">
    <h2>Lista de Dueños</h2>

    <form method="post">
        <input type="hidden" name="convertir" value="<?php echo $isConverted ? '0' : '1'; ?>">
        <button type="submit" class="btn btn-secondary mb-3">
            <?php echo $isConverted ? 'Ver Información de Dueños' : 'Ver por Tipo de Impuesto'; ?>
        </button>
    </form>

    <?php if ($isConverted): ?>
        <h2>Ver por Tipo de Impuesto</h2>
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Impuesto</th>
                            <th>Personas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($personas as $ci => $data): ?>
                            <tr>
                                <td><?php echo $data['tipo_impuesto']; ?></td>
                                <td>
                                    <?php
                                    $nombreCompleto = $data['nombre'] . ' ' . $data['paterno'] . ' ' . $data['materno'];
                                    echo $nombreCompleto . ' (Códigos Catastrales: ' . implode(', ', $data['codigos_catastrales']) . ')';
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <h2>Ver Información de Dueños</h2>
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Paterno</th>
                            <th>Materno</th>
                            <th>Código Catastral</th>
                            <th>Tipo de Impuesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Reiniciar el puntero del resultado para volver a mostrar la tabla original
                        mysqli_data_seek($result, 0);
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['ci']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['paterno']; ?></td>
                                <td><?php echo $row['materno']; ?></td>
                                <td><?php echo $row['codigo_catastral']; ?></td>
                                <td><?php echo $row['tipo_impuesto']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>