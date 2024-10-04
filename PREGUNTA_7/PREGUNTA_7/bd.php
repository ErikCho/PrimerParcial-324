<?php
$con = mysqli_connect("localhost", "root", "", "BDErik7");

if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>