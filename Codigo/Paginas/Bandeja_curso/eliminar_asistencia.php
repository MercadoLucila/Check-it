<?php

require_once "../../Clases/conexion.php";
require_once "../../Clases/Materia.php";
require_once "../../Clases/Alumno.php";
require_once "../../Clases/Asistencia.php";
require_once '../../Clases/Ram.php';

$database = new Database();
$conn = $database -> connect();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('Y-m-d');

if($_SERVER["REQUEST_METHOD"] == "POST" or $_SESSION['materia'] != NULL){
    
    if(isset($_POST['materia'])){
        $materia = $_POST['materia'];
        $_SESSION['materia']=$materia;
    }else{
        $materia = $_SESSION['materia'];
    }

    if(isset($_POST['ausentes'])){
        $ausentes=$_POST["ausentes"];
        foreach($ausentes as $ausente){
            $asistencia=new Asistencia($materia,$ausente,$fecha);
            $asistencia->eliminar_asistencia($conn);
        }
    }
}
$presentes=[];
$alumnos = Alumno::buscarAlumnos($conn,$materia);
foreach($alumnos as $alumno){
    $presente=Asistencia::verificar_asistencia($conn,$alumno["DNI"],$materia,$fecha);
    if($presente){
        array_push($presentes,$alumno);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/eliminar_asistencias.css">
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
                
                    <div>
                        <table>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha de Nacimiento</th>
                                <th>DNI</th>
                                <th>Fecha</th>
                                <th>Presente</th>
                            </tr>                    
                            <form action="eliminar_asistencia.php" method="post">
                                <?php 
                                    if(!$presentes){
                                        echo '<tr>Sin alumnos presentes el día de hoy</tr>';
                                    }else{
                                        foreach($presentes as $alumno){
                                            echo '<tr><td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
                                            <td>'.$alumno["email"].'</td><td>'.$alumno["nacimiento"].'</td>
                                            <td>'.$alumno["DNI"].'</td>
                                            <td>'.$fecha.'</td>
                                            <td><button type="submit" name="ausentes[]" value="'.$alumno["DNI"].'">Eliminar Asistencia</button>';
                                        }
                                    }
                                ?>

                            </form>
                        </table>
                     </div>  
                </div>
        </div>
   </header>
    
</body>
</html>



