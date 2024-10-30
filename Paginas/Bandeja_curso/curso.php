<?php

require_once "../../Clases/conexion.php";
require_once "../../Clases/Materia.php";
require_once "../../Clases/Alumno.php";

$database = new Database();
$conn = $database -> connect();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/style_bandeja.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">

    <title>Check-it Curso</title>
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="../Main Page/index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
        </div>

        <nav class="navbar">
            <a href="../Main Page/index.php">Inicio</a>
            <a href="#">Contacto</a>
            <a href="#">QA</a>
        </nav>

    </div>

   <header class="header">
        <div class="formulario_instituto" id="formulario_instituto"></div>

        <div class="bandeja">
                <div>
                    <table>
                        <tr>
                            <td>Nombre</td>
                            <td>Email</td>
                            <td>Fecha de Nacimiento</td>
                            <td>DNI</td>
                            <td>Puntuacion</td>
                            <td>Presente</td>
                            <td>Eliminar Alumno</td>
                    <?php
                        
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $materia = $_POST['materia'];
                            $alumnos = Alumno::buscarAlumnos($conn,$materia);
                            var_dump($alumnos);

                            echo '<form name="materia" action="../Bandeja_curso/curso.php" method="POST">';
                            foreach($alumnos as $alumno){
                                echo '<tr>
                                <td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
                                <td>'.$alumno["email"].'</td>
                                <td>'.$alumno["nacimiento"].'</td>
                                <td>'.$alumno["DNI"].'</td>
                                <td>agregar puntuacion</td>
                                <td><input type="checkbox" name="presentes[]" value="'.$alumno["DNI"].'"></td>
                                <td></td>';
                            }
                            echo '</form>';
                            

                            
                    
                        
                        }
                        
                    ?>
                    <button></button>
                    </table>
                </div>
        </div>

        <div class="solapas">
            <a href="../Bandeja_Principal/bandeja.php">Institutos</a>
            <a href="#">Materias</a>

            <input type="checkbox">

        </div>
        
   </header>
    
</body>
</html>



