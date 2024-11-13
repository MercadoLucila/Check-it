<?php
require_once '../../Clases/conexion.php';
$database = new Database();
$conn = $database->connect();

function clean_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../Resources/CSS/formulario.css">
<link rel="icon" href="../../Resources/imagenes/Logo.ico">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Check-it Instancia Evaluativa</title>
</head>
<body>
<div class="head">

    <div class="logo">
        <a href="../../index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
    </div>

    <nav class="navbar">
        <a href="../Bandeja_institutos/index_institutos.php">Inicio</a>
        <a href="../../index.php">Cerrar Sesión</a>
    </nav>

</div>
<div class="image"></div>
<header class="header">

    <div class="bandeja">
        <div class="interactivos">
            <a href="curso.php" >Volver</a>
        </div>

        <form name="fecha" action="agregar_nota.php" method="post">
            <label for="fecha">Fecha del Parcial</label>
            <input id="fecha" name="fecha" type="date" required>

            <button type="submit">Subir Fecha</button>

            <p>Antes de continuar es necesario que indique la fecha en la que se tomó la instancia evaluativa.</p>
        </form>

    </div>
    
</header>

</body>
</html>




