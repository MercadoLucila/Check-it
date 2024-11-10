<?php
    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Ram.php';
    require_once '../../Clases/Instituto.php';

    $database = new Database();
    $conn = $database->connect();

    session_start();

    function clean_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    $rams=Ram::institutos_con_ram($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/formulario.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Check-it Ram</title>
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
                <a href="../Bandeja_institutos/index_institutos.php" >Volver</a>
            </div>

            <form action="../Bandeja_ram/eliminar_ram.php" method="post">

            <h3>Eliminar Ram</h3>

                <label for="institutos">Seleccione el instituto del cual desea borrar su Ram</label>
                <select name="institutos" id="institutos">
                    <?php
                    foreach($rams as $ram){
                        echo'<option name="CUE" value="'.$ram["CUE"].'">'.$ram["nombre"].'</option>';
                    }
                    ?>
                </select>
                

                <?php 
                   if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $CUE = $POST["CUE"];
                        Ram::eliminar_ram($conn,$CUE);
                        $checkeo=Ram::checkear_ram($conn,$CUE);
                        if(!$checkeo){
                            echo '<p>Ram dado de baja correctamente. Actualice la página para ver los cambios.</p>';
                        }else{
                            echo '<p>El ram no se pudo dar de baja.</p>';
                        }
                    }  
                ?>
                <div>
                    <button type="submit">Eliminar Ram</button>
                </div>

                
            </form>
        </div>
        
   </header>
    
</body>
</html>
