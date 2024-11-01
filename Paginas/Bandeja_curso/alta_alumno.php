<?php

    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Alumno.php';

    $database = new Database();
    $conn = $database->connect();

    session_start();
    $materia=$_SESSION['materia'];

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
            <a href="#">Contacto</a>
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
            <form id="formulario" name="subir_alumno" action="alta_alumno.php" method="post">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" required>

                <label for="apellido">Apellido</label>
                <input id="apellido" name="apellido" type="text" required>

                <label for="email">Email</label>
                <input id="email" name="email" type="email">

                <label for="DNI">DNI</label>
                <input id="DNI" name="DNI" type="number">

                <label for="nacimiento">Fecha de Nacimiento</label>
                <input id="nacimiento" name="nacimiento" type="date">
                <?php 
                    if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $nombre = clean_input($_POST['nombre']);
                        $apellido = clean_input($_POST['apellido']);
                        $email = clean_input($_POST['email']);
                        $DNI = clean_input($_POST['DNI']);
                        $nacimiento = clean_input($_POST['nacimiento']);

                        $alumno=new Alumno($nombre,$apellido,$email,$DNI,$nacimiento);
                        $checkeo=$alumno->corroborarAlumno($conn);
                        if($checkeo){
                            $matriculacion=$alumno->checkearMatricula($conn,$materia);
                        }else{
                            $alumno->subirAlumno($conn);
                            $checkeo=$alumno->corroborarAlumno($conn);
                            if($checkeo){
                                echo ('<p> El alumno se dio de alta correctamente </p>');   
                            }else{
                                echo ('<p> No se pudo dar de alta el alumno</p>');
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



