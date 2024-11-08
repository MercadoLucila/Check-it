<?php

    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Alumno.php';

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
    <link rel="stylesheet" href="../../Resources/CSS/formulario.css">
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
            <a href="../Bandeja_institutos/index_institutos.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
        </nav>

    </div>
    
    <div class="image"></div>
    <header class="header">

        <div class="bandeja">
            <div class="interactivos">
                    <a href="curso.php" >Volver</a>
            </div>

            <div>
                
                <form id="formulario" name="subir_alumno" action="modificar_alumno.php" method="post">
                    <h3>Modificar Alumno</h3>
                    <label for="DNI">Alumno a editar</label>
                    <select id="DNI" name="DNI" required>
                        <?php
                        if($alumnos){
                            foreach($alumnos as $alumno){
                                echo '<option name="DNI" value="'.$alumno['DNI'].'">' . $alumno['nombre'] .' '. $alumno['apellido'] . '</option>';
                            }
                        }else{
                            echo '<option>Sin alumnos para editar</option>';
                        }
                        
                        ?>
                    </select>

                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" type="text" required>

                    <label for="apellido">Apellido</label>
                    <input id="apellido" name="apellido" type="text" required>

                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required>

                    <label for="nacimiento">Fecha de Nacimiento</label>
                    <input id="nacimiento" name="nacimiento" type="date" required>

                    <?php 
                        if($_SERVER ["REQUEST_METHOD"] == "POST"){
                            $nombre = clean_input($_POST['nombre']);
                            $apellido = clean_input($_POST['apellido']);
                            $email = clean_input($_POST['email']);
                            $DNI = clean_input($_POST['DNI']);
                            $nacimiento = clean_input($_POST['nacimiento']);

                            $alumno=new Alumno($DNI,$nombre,$apellido,$email,$nacimiento);
                            $alumno->actualizar_alumno($conn);
                            $checkeo=$alumno->checkear_actualizacion($conn);
                            if($checkeo){
                                echo '<p>El alumno se actualizo correctamente</p>';
                            }else{
                                echo '<p>No se pudo actualizar el alumno</p>';
                            }
                            
                        }
                    ?>
                    <div>
                        <input type="submit" value="Actualizar Alumno">
                    </div>
                    
                </form>
            </div>
        </div>
        
   </header>
    
</body>
</html>



