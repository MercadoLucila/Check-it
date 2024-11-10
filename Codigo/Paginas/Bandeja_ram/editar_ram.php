<?php

require_once '../../Clases/conexion.php';
require_once '../../Clases/Ram.php';

$database = new Database();
$conn = $database->connect();
session_start();
$CUE=$_SESSION["instituto"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/formulario.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">
    <script src="../../Resources/JS/fn.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Check-it Institutos</title>
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
                    <a href="../Bandeja_materias/index_materias.php" >Volver</a>
            </div>

            <div>
                
                <form id="formulario" name="editar_ram" action="editar_ram.php" method="post">
                    <h3>Editar RAM</h3>
                    <label for="nota_regular">Nota regular</label>
                    <input id="nota_regular" name="nota_regular" type="number" required>

                    <label for="nota_promocion">Nota promocion</label>
                    <input id="nota_promocion" name="nota_promocion" type="number" required>

                    <label for="porcentaje_regular">Porcentaje asistencias regular</label>
                    <input id="porcentaje_regular" name="porcentaje_regular" type="number" required>

                    <label for="porcentaje_promocion">Porcentaje asistencias promocion</label>
                    <input id="porcentaje_promocion" name="porcentaje_promocion" type="number" required>

                    <?php 
                        if($_SERVER ["REQUEST_METHOD"] == "POST"){

                            $nota_regular = $_POST['nota_regular'];
                            $nota_promocion = $_POST['nota_promocion'];
                            $porcentaje_regular = $_POST['porcentaje_regular'];
                            $porcentaje_promocion = $_POST['porcentaje_promocion'];

                            $ram=new Ram($CUE,$nota_regular,$nota_promocion,$porcentaje_regular,$porcentaje_promocion);
                            $ram->editar_ram($conn);
                            echo '<p> El ram se ha editado correctamente</p>';

                        }
                        
                    ?>
                    <div>
                        <input type="button" value="Matricular Alumno" onclick="editarRam()">
                    </div>
                    
                </form>
            </div>
        </div>
        
   </header>
    
</body>
</html>

