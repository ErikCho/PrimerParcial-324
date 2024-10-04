<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Catastro - La Paz, Bolivia</title>
    <style>
        body {
            background-image: url('imagenes/fondo.jpg'); /* Ruta a tu imagen */
            background-size: cover; /* Ajustar la imagen al tamaño de la ventana */
            background-repeat: no-repeat; /* No repetir la imagen */
            background-position: center; /* Centrar la imagen */
            color: #333; /* Color del texto por defecto */
        }
        header {
            background-image: url('imagenes/cabecera.png'); /* Ruta a tu imagen */
            background-size: 300px; /* Ajustar la imagen al tamaño del header */
            background-repeat: no-repeat; /* No repetir la imagen */
            background-position: top left; /* Centrar la imagen horizontalmente */
            height: 200px; /* Ajusta la altura del header */
            display: flex; /* Usar flexbox para centrar el contenido */
            flex-direction: column; /* Colocar el contenido en columnas */
            align-items: center; /* Centrar verticalmente el contenido */
            justify-content: center; /* Centrar horizontalmente el contenido */
            color: white; /* Color del texto en blanco */
        }

        h1 {
            font-size: 3rem; /* Tamaño de fuente del título */
            margin-bottom: 10; /* Sin margen inferior */
            color: white;
        }
        h2 {
            font-size: 3rem; /* Tamaño de fuente del título */
            margin-bottom: 10; /* Sin margen inferior */
            color: greenyellow;
        }
        h4 {
            font-size: 3rem; /* Tamaño de fuente del título */
            margin-bottom: 10; /* Sin margen inferior */
            color: greenyellow;
        }

        p {
            font-size: 1.7rem; /* Tamaño de fuente del subtítulo */
            margin-top: 10; /* Sin margen superior */
            color: white;
        }
        
        .p1 {
            font-size: 1.0rem; /* Tamaño de fuente del subtítulo */
            margin-top: 10; /* Sin margen superior */
            align-items: center; /* Centrar verticalmente el contenido */
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
        }

        .nav-link {
            color: #007bff; /* Color del enlace */
        }

        .nav-link:hover {
            color: #0056b3; /* Color del enlace al pasar el mouse */
        }
    </style>
</head>
<body>
    <header>
        <h1>Área de Catastro</h1>
        <p>Gobierno Autónomo Municipal de La Paz</p>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="info_general.php">Información General</a></li>
                    <li class="nav-item"><a class="nav-link" href="tramites.php">Tipos de Trámites</a></li>
                </ul>
            </div>
        </nav>
    </header>