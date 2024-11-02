<?php

    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Instituto.php';
    require_once '../../Clases/Profesor_Instituto.php';

    $database = new Database();
    $conn = $database->connect();

    session_start();

    function clean_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/add_instituto.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Check-it Institutos</title>
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="../../index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
        </div>

        <nav class="navbar">
            <a href="../Bandeja_Principal/badeja.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
            <a href="#">QA</a>
        </nav>

    </div>

   <header class="header">

        <div class="bandeja">
            <div class="interactivos">
                <a href="index_institutos.php" >Volver</a>
            </div>

            <h3>Agregar Instituto</h3>
            <form id="formulario" name="add_instituto" action="add_instituto.php" method="post">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" required>

                <label for="CUE">CUE</label>
                <input id="CUE" name="CUE" type="number" required>

                <label for="descripcion">Descripcion</label>
                <input id="descripcion" name="descripcion" type="text">

                <label for="direccion">Direccion</label>
                <input id="direccion" name="direccion" type="text">

                <div class="radios">
                    <p>Nivel</p>
                    <label for="primario">
                        <input type="radio" id="primario" name="nivel" value="Primario" required>
                        Primario
                    </label>
                    <label for="secundario">
                        <input type="radio" id="secundario" name="nivel" value="Secundario">
                        Secundario
                    </label>
                    <label for="secundarioTecnico">
                        <input type="radio" id="secundarioTecnico" name="nivel" value="Secundario Tecnico">
                        Secundario Técnico
                    </label>
                    <label for="terciario">
                        <input type="radio" id="terciario" name="nivel" value="Terciario Tecnico Superior">
                        Terciario Tecnico Superior
                    </label>
                    <label for="universitario">
                        <input type="radio" id="universitario" name="nivel" value="Universitario">
                        Universitario
                    </label>
                </div>
                <?php 
                    if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $nombre = clean_input($_POST['nombre']);
                        $CUE = clean_input($_POST['CUE']);
                        $descripcion = clean_input($_POST['descripcion']);
                        $direccion = clean_input($_POST['direccion']);
                        $nivel = clean_input($_POST['nivel']);
                        
                        $profesor = $_SESSION['profesor'];
                        $legajo = $profesor["legajo"];

                        $instituto=new Instituto($CUE,$direccion,$descripcion,$nivel,$nombre);
                        $checkeo=$instituto->corroborarInstituto($conn);
                        $asignacion=new Profesor_Instituto($legajo,$CUE);
                        $checkeo_asignacion=$asignacion->checkear_profesor_instituto($conn);

                        if($checkeo){
                            if($checkeo_asignacion){
                                echo ('<p> Ya existe un instituto con ese CUE registrado </p>');  
                            }else{
                                $asignacion->subir_profesor_instituto($conn);
                                echo ('<p> El instituto ya estaba creado, acabamos de asignarselo </p>');  
                            }
                        }else{
                            $instituto->subirInstituto($conn);
                            $asignacion->subir_profesor_instituto($conn);
                            $checkeo=$instituto->corroborarInstituto($conn);
                            $checkeo_asignacion=$asignacion->checkear_profesor_instituto($conn);
                            if($checkeo and $checkeo_asignacion){
                                echo ('<p> Se ha subido y asignado el instituto correctamente </p>');   
                            }else{
                                echo ('<p> No se pudo subir o asignar el instituto por algun error</p>');
                            }
                        }
                    }
                ?>
                <div>
                    <button type="submit">Subir Instituto</button>
                </div>

                
            </form>
        </div>
        
   </header>
    
</body>
</html>
