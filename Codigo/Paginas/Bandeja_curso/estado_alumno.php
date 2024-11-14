<?php
require_once '../../Clases/conexion.php';
require_once '../../Clases/Alumno.php';
require_once '../../Clases/Nota.php';
require_once '../../Clases/Asistencia.php';
require_once '../../Clases/Ram.php';

$database = new Database();
$conn = $database->connect();

function clean_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

session_start();
$materia = $_SESSION['materia'];
$alumnos = Alumno::buscarAlumnos($conn,$materia);
$ram=Ram::obtener_ram($conn,$_SESSION["instituto"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../Resources/CSS/estado_alumno.css">
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

<header class="header">

    <div class="bandeja2">
       
        <table>
            <tr>
                <th>Nombre</th>
                <th>Porcentaje de Asistencias</th>
                <th>Primer Parcial</th>
                <th>Segundo Parcial</th>
                <th>Tercer Nota</th>
                <th>Promedio</th>
                <th>Estado</th>
            </tr>                    
        
            <?php 
            foreach($alumnos as $alumno){
                $calificaciones=[];
                $notas=Nota::buscar_nota($conn,$alumno["DNI"],$materia);
                $calculo_promedio=Nota::calcular_promedio($conn,$alumno["DNI"],$materia);
                $promedio=number_format($calculo_promedio["promedio"] / 1, 2);
                $buscar_promedio_asistencia=Asistencia::promedio_asistencia($conn,$alumno["DNI"],$materia);
                $promedio_asistencia=number_format($buscar_promedio_asistencia["porcentaje_asistencia"]/ 1);
                echo '<tr><td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>';
                echo '<td>'.$promedio_asistencia.'%</td>';
                $cont=0;
                foreach($notas as $nota){
                    $cont=$cont+1;
                    echo '<td>'.$nota["calificacion"].'</td>';
                    array_push($calificaciones,$nota["calificacion"]);
                }
                while($cont<3){
                    $cont=$cont+1;
                    echo '<td>-</td>';
                }
                echo '<td>'.$promedio.'</td>';
                if(!$ram){
                    echo '<td>Se necesita RAM</td></tr>';
                }else{
                    $estado=Ram::obtener_estado($conn,$_SESSION["instituto"],$calificaciones,$promedio_asistencia);
                    echo '<td>'.$estado.'</td></tr>';
                }
            }
            ?>
        </table>
    </div>
    <div class="bandeja">
            <a href="curso.php" >Volver</a>
        <?php 
                if(!$ram){
                    echo '<p>Para poder mostrar el estado del alumno es necesario que ingrese la RAM del instituto'.' 
                    <b>¿Desea agregar RAM al instituto '.$_SESSION["instituto.nombre"].'?</b> </p>
                    <a href="../Bandeja_ram/ram_instituto.php" > Agregar RAM </b></a>'; 
                }
            ?>
    </div>
    
</header>

</body>
</html>




