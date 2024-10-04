<?php
$con = mysqli_connect("localhost", "root", "", "BDErik");

if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>