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
            <a href="../Bandeja_institutos/index_institutos.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
        </nav>

    </div>
    <header class="header">
        <div class="bandeja">
            <a class="interactivos" href="curso.php">Volver a Curso</a>
            <div class="bandeja1" >
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Nacimiento</th>
                            <th>DNI</th>
                            <th>Eliminar Alumno</th>
                        <?php
                        
                            if($_SERVER["REQUEST_METHOD"] == "POST" or $_SESSION['materia'] != NULL){
                                if(isset($_POST['materia'])){
                                    $materia = $_POST['materia'];
                                    $_SESSION['materia']=$materia;
                                }else{
                                    $materia = $_SESSION['materia'];
                                }

                                $alumnos = Alumno::buscarAlumnos($conn,$materia);
                                
                                if(isset($_POST["eliminar_alumno"])){
                                    $DNI=$_POST["eliminar_alumno"];
                                    $materia= $_SESSION['materia'];
                                    Alumno::eliminarAlumno_Materia($conn,$DNI,$materia);
                                    header("location: eliminar_alumno.php");
                                    exit();
                                }

                                if(!$alumnos){
                                    echo '<p>Aún no hay alumnos matriculados en esta materia</p>';
                                }else{
                                    foreach($alumnos as $alumno){
                                    echo '<tr><td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
                                    <td>'.$alumno["email"].'</td><td>'.$alumno["nacimiento"].'</td>
                                    <td>'.$alumno["DNI"].'</td>
                                    <td>
                                        <form name="eliminar_alumno" action="eliminar_alumno.php" method="POST">
                                        <button name="eliminar_alumno" type="submit" value="'.$alumno["DNI"].'">Dar de baja</button></form>
                                    
                                    </td></tr>';
                                    }
                                    

                                }
                            
                            }
                        
                        ?>
                    </table>
                </div>
            
        </div>
        <div class="solapas">
            <a href="alta_alumno.php" > Agregar Alumno </a>
            <a href="#" > Agregar RAM a <?php echo'<b>'.$_SESSION["instituto.nombre"].'</b>'?></a>
            <a href="../Bandeja_institutos/index_institutos.php">Institutos</a>
            <a href="curso.php">Volver a Curso</a>

        </div>
        
   </header>
    
</body>
</html>



