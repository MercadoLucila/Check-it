<?php

require_once "../../Clases/conexion.php";
require_once "../../Clases/Materia.php";
require_once "../../Clases/Alumno.php";
require_once "../../Clases/Asistencia.php";

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

    if(isset($_POST['presentes'])){
        $presentes=$_POST["presentes"];
        foreach($presentes as $presente){
            $asistencia=new Asistencia($materia,$presente,$fecha);
            $asistencia->tomar_asistencia($conn);
        }
    }


}

$alumnos = Alumno::buscarAlumnos($conn,$materia);




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
            <a class="interactivos" href="../Bandeja_materias/index_materias.php">Volver a Materias</a>
            <div class="bandeja1" >
                    <div>
                        <table>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha de Nacimiento</th>
                                <th>DNI</th>
                                <th>Presente</th>
                            </tr>                    
                        
                        <form action="curso.php" method="post">
                        <?php 
                            if($alumnos){
                                foreach($alumnos as $alumno){
                                    echo '<tr><td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
                                    <td>'.$alumno["email"].'</td><td>'.$alumno["nacimiento"].'</td>
                                    <td>'.$alumno["DNI"].'</td>
                                    <td><input type="checkbox" name="presentes[]" value="'.$alumno["DNI"].'"></td>';
                                }
                            }
                        ?>
                    
                        <input type="submit" value="Subir Asistencia">
                        </form>
                        </table>
                    </div>
                
            </div>
        </div>
        <div class="solapas">
            <a href="alta_alumno.php" > Agregar Alumno </a>
            <a href="eliminar_alumno.php">Eliminar Alumno</a>
            <a href="modificar_alumno.php">Editar Alumno</a>
            <a href="agregar_nota.php">Subir Notas</a>
            <a href="../Bandeja_ram/ram.php" > Agregar RAM a <?php echo'<b>'.$_SESSION["instituto.nombre"].'</b>'?></a>
            <a href="../Bandeja_institutos/index_institutos.php">Inicio</a>

            

        </div>
        
   </header>
    
</body>
</html>



