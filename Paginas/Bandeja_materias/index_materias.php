<?php

require_once "../../Clases/conexion.php";
require_once "../../Clases/Materia.php";
require_once "../../Clases/Profesor_Instituto.php";
require_once "../../Clases/Instituto.php";
require_once "../../Clases/Ram.php";

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

    <title>Check-it Materias</title>
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="../../index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
        </div>

        <nav class="navbar">
            <a href="../Bandeja_Principal/bandeja.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
            <a href="#">QA</a>
        </nav>

    </div>

   <header class="header">
        <div class="formulario_instituto" id="formulario_instituto"></div>

        <div class="bandeja">
                <div>
                    <?php
                        
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $CUE = $_POST['instituto'];
                            $profesor = $_SESSION['profesor'];
                            $legajo = $profesor["legajo"];

                            $asignacion=new Profesor_Instituto($legajo,$CUE);
                            $buscar_asignacion=Profesor_Instituto::buscar_asignacion($conn,$CUE,$legajo);
                            $materias=Materia::buscarMaterias($conn,$buscar_asignacion);

                            echo '<form name="materia" action="../Bandeja_curso/curso.php" method="POST">';
                            foreach($materias as $materia){
                                echo '<button name="materia" type="submit" value="'.$materia['codigo_materia'].'">' . $materia['nombre'] . '</button>';
                            }
                            echo '</form>';

                            $_SESSION['instituto']=$CUE;
                            $instituto=Instituto::buscarInstituto($conn,$CUE);
                            $_SESSION['instituto.nombre']=$instituto["nombre"];

                        }else{
                            $CUE = $_SESSION['instituto'];
                            $profesor = $_SESSION['profesor'];
                            $legajo = $profesor["legajo"];
                            $instituto=Instituto::buscarInstituto($conn,$CUE);

                            $asignacion=new Profesor_Instituto($legajo,$CUE);
                            $buscar_asignacion=Profesor_Instituto::buscar_asignacion($conn,$CUE,$legajo);
                            $materias=Materia::buscarMaterias($conn,$buscar_asignacion);

                            echo '<form name="materia" action="../Bandeja_curso/curso.php" method="POST">';
                            foreach($materias as $materia){
                                echo '<button name="materia" type="submit" value="'.$materia['codigo_materia'].'">' . $materia['nombre'] . '</button>';
                            }
                            echo '</form>';
                        }


                        
                    ?>
                </div>
        </div>

        <?php 
            /*
            if(){

            }
            */
        ?>


        <div class="solapas">
            <a href="../Bandeja_institutos/index_institutos.php">Volver a Institutos</a>
            <a href="agregar_materia.php">Agregar Materia a Instituto <?php echo '<b>'.$instituto["nombre"].'</b>' ?></a>
            <a href="agregar_materia.php">Agregar RAM a instituto <?php echo '<b>'.$instituto["nombre"].'</b>' ?></a>
        </div>
        
   </header>
    
</body>
</html>



