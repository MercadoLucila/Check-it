<?php

    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Instituto.php';

    $database = new Database();
    $conn = $database->connect();

    $institutos=Instituto::buscarInstitutos($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/style_bandeja.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">
    <script src="../../Resources/JS/agregarInstituto.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Check-it Institutos</title>
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="../../index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
        </div>

        <nav class="navbar">
            <a href="../Bandeja_Principal/badeja.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
            <a href="#">QA</a>
        </nav>

    </div>

   <header class="header">
        <div class="formulario_instituto" id="formulario_instituto"></div>

        <div class="bandeja">
                <div>
                    <?php

                        echo '<form id="cue_instituto" name="cue_instituto" action="../Bandeja_materias/index_materias.php" method="POST">';
                        foreach($institutos as $fila){
                            echo '<button name="instituto" type="submit" value="'.$fila['CUE'].'">' . $fila['nombre'] . '</button>';
                        }
                        echo '</form>';
                        
                    ?>
                </div>
        </div>

        <div class="solapas">
            <a href="add_instituto.php" > Agregar Instituto </a>
            <a href="../Bandeja_Principal/bandeja.php">Institutos</a>
            <a href="#">Materias</a>

        </div>
        
   </header>
    
</body>
</html>

