<?php
include 'bd.php';

if (isset($_GET['macrodistrito_id'])) {
    $macrodistrito_id = intval($_GET['macrodistrito_id']);

    $stmt = $con->prepare("SELECT id, nombre FROM zonas WHERE macrodistrito_id = ?");
    $stmt->bind_param("i", $macrodistrito_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $zonas = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($zonas);
} else {
    echo json_encode([]);
}
?>