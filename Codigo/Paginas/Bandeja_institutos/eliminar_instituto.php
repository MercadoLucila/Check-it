<?php
    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Instituto.php';
    require_once '../../Clases/Profesor_Instituto.php';

    $database = new Database();
    $conn = $database->connect();

    session_start();
    $legajo=$_SESSION["profesor.legajo"];
    $institutos=Instituto::buscarInstitutos($conn,$legajo);

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
                <a href="index_institutos.php" >Volver</a>
            </div>

            
            <form action="eliminar_instituto.php" method="post">
                <h3>Eliminar Instituto</h3>
                <label for="materia">Seleccione el instituto que desea eliminar</label>
               
                <select name="CUE" required>
                    <?php
                    if($institutos){
                        foreach($institutos as $instituto){
                            echo '<option name="codigo_materia" value="'.$instituto["CUE"].'">'. $instituto["nombre"] .'</option>';
                        }
                    }else{
                        echo '<option>No hay Institutos para eliminar</option>';
                    }
                    ?>
                </select>
                <?php 
                    if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $CUE =$_POST['CUE'];
                        Instituto::eliminarInstituto($conn,$CUE);
                        $check=Instituto::corroborarInstituto($conn,$CUE);
                        if(!$check){
                            echo '<p>El instituto fue eliminado con exito, actualice la página para ver los cambios.</p>';
                        }else{
                            echo '<p>El instituto no pudo ser eliminado</p>';
                        }
                    
                    }
                ?>
                <div>
                    <button type="submit">Eliminar Instituto</button>
                </div>

                
            </form>
        </div>
        
   </header>
    
</body>
</html>
