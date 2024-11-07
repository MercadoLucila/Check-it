<?php
require_once '../../Clases/conexion.php';
require_once '../../Clases/Alumno.php';
require_once '../../Clases/Nota.php';

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


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../Resources/CSS/add_instituto.css">
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
        <a href="../Bandeja_Principal/bandeja.php">Inicio</a>
        <a href="../../index.php">Cerrar Sesión</a>
    </nav>

</div>

<header class="header">

    <div class="bandeja">
        <div class="interactivos">
            <a href="curso.php" >Volver</a>
        </div>

        <form action="agregar_nota.php" method="post">
            <label for="fecha">Fecha del Parcial</label>
            <input id="fecha" name="fecha" type="date" required>

            <input type="submit" value="Subir Fecha">
        </form>

        <h3>Instancia Evaluativa </h3>
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
                    if(isset($_POST["fecha"])){
                        $_SESSION["fecha_parcial"]=$_POST["fecha"];
                        var_dump($_SESSION["fecha_parcial"]);
                    } 
                    if(isset($_POST['DNI'])){
                        $DNI = clean_input($_POST['DNI']);
                        $nota = clean_input($_POST['nota']);
                        $fecha = $_SESSION["fecha_parcial"];

                        var_dump($DNI);
                        var_dump($nota);
                        var_dump($fecha);

                        $calificacion=new Nota($materia,$DNI,$nota,$fecha);
                        $calificacion->subir_nota($conn);
                        $checkeo_nota=$calificacion->checkear_nota($conn);
                        if($checkeo_nota){
                            echo '<p> Nota subida correctamente </p>';
                        }else{
                            echo '<p> No se pudo subir la nota </p>';
                        }
                    }  
                        
                }
            ?>
    </div>

    <div class="bandeja2">

    </div>
    
</header>

</body>
</html>




