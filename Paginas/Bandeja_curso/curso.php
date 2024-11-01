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
    <link rel="stylesheet" href="../../Resources/CSS/curso.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">

    <title>Check-it Curso</title>
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="../../index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
        </div>

        <nav class="navbar">
            <a href="#">Contacto</a>
            <a href="../../index.php">Cerrar Sesión</a>
            <a href="#">QA</a>
        </nav>

    </div>

   <header class="header">

        <div class="bandeja">
                <div>
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Nacimiento</th>
                            <th>DNI</th>
                            <th>Puntuacion</th>
                            <th>Presente</th>
                            <th>Eliminar Alumno</th>
                    <?php
                        
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            if(isset($_POST['materia'])){
                                $materia = $_POST['materia'];
                                $_SESSION['materia']=$materia;
                            }
                            
                            
                            if(isset($_POST["eliminar_alumno"])){
                                $DNI=$_POST["eliminar_alumno"];
                                $materia= $_SESSION['materia'];
                                Alumno::eliminarAlumno_Materia($conn,$DNI,$materia);
                            }

                            $alumnos = Alumno::buscarAlumnos($conn,$materia);


                            echo '<form name="materia" action="../Bandeja_curso/curso.php" method="POST">';
                            foreach($alumnos as $alumno){
                                echo '<tr><td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td><td>'.$alumno["email"].'</td><td>'.$alumno["nacimiento"].'</td><td>'.$alumno["DNI"].'</td>
                                <td>agregar puntuacion</td>
                                <td><input type="checkbox" name="presentes[]" value="'.$alumno["DNI"].'"></td>
                                <td><form name="eliminar" action="../Bandeja_curso/curso.php" method="POST">
                                <button name="eliminar_alumno" type="submit" value="'.$alumno["DNI"].'">Dar de baja</button>
                                </form></td>';
                                
                            }
                            echo '</form>';
                            

                            
                    
                        
                        }
                        
                    ?>
                    </table>
                </div>
        </div>
        <div>
            <a href="alta_alumno.php" > Agregar Alumno </a>
        </div>
        <div class="solapas">
            <a href="../Bandeja_Principal/bandeja.php">Institutos</a>
            <a href="#">Materias</a>

        </div>
        
   </header>
    
</body>
</html>



