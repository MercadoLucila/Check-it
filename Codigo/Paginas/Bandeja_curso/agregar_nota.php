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

if(isset($_POST["fecha"])){
    $_SESSION["fecha_parcial"]=$_POST["fecha"];
    $fecha = $_SESSION["fecha_parcial"];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../Resources/CSS/notas.css">
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

    <div class="bandeja">
        <div class="interactivos">
            <a href="curso.php" >Volver</a>
        </div>

        <h3>Instancia Evaluativa del <?php echo'<b>'.$fecha.'</b>';  ?></h3>
        <form id="nota_alumno" name="nota_alumno" action="agregar_nota.php" method="post">

            <label for="DNI">Alumno</label>
            <select id="DNI" name="DNI" required>
                <?php
                foreach($alumnos as $alumno){
                    echo '<option name="DNI" value="'.$alumno['DNI'].'">' . $alumno['nombre'] .' '. $alumno['apellido'] . '</option>';
                }
                ?>
            </select>

            <label for="nota">Nota</label>
            <input id="nota" name="nota" type="number" step="0.01" required>

            <div>
                <button type="submit">Cargar Nota</button>
            </div>
            
        </form>

        <?php 
                if($_SERVER ["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST['DNI'])){
                        $DNI = clean_input($_POST['DNI']);
                        $nota = clean_input($_POST['nota']);

                        $calificacion=new Nota($materia,$DNI,$nota,$fecha);
                        $checkeo_nota=$calificacion->checkear_nota($conn);
                        if($checkeo_nota){
                            echo '<p> Ya subió la nota de este alumno y ese parcial </p>';
                        }else{
                            $calificacion->subir_nota($conn);
                            $calificacion=new Nota($materia,$DNI,$nota,$fecha);
                            $checkeo_nota=$calificacion->checkear_nota($conn);
                            if($checkeo_nota){
                                echo '<p> Nota subida correctamente </p>';
                                header("location: agregar_nota.php");
                                exit();
                            }else{
                                echo '<p> No se pudo subir la nota </p>';
                            }
                        }
                    }  
                        
                }
                if(!$ram){
                    echo '<p>Para poder mostrar el estado del alumno es necesario que ingrese la RAM del instituto '.$_SESSION["instituto.nombre"].'. 
                    ¿Desea agregar RAM al instituto '.$_SESSION["instituto.nombre"].'? </p>
                    <a href="../Bandeja_ram/ram_instituto.php" > Agregar RAM a <b>'.$_SESSION["instituto.nombre"].'</b></a>'; 
                }
            ?>
    </div>

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
    
</header>

</body>
</html>




