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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/add_instituto.css">
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
            <a href="../Bandeja_Principal/badeja.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
        </nav>

    </div>

   <header class="header">

        <div class="bandeja">
            <div class="interactivos">
                <a href="index_institutos.php" >Volver</a>
            </div>

            <h3>Agregar Ram a <?php echo '<b>'.$_SESSION['instituto.nombre'].'</b>' ?> </h3>
            <form id="formulario" name="add_ram" action="ram.php" method="post">
                <label for="regular">Nota Regular Mínima</label>
                <input id="regular" name="nota_regular" type="number" required>

                <label for="promocion">Nota Promocional Mínima</label>
                <input id="promocion" name="nota_promocion" type="number" required>

                <label for="porcentaje_regular">Porcentaje de asistencia para estado Regular:</label>
                <span>%
                <input type="number" id="porcentaje_regular" name="porcentaje_regular" min="0" max="100" step="0.01">
                </span>
                

                <label for="porcentaje_promocion">Porcentaje de asistencia para estado Promocional:</label>
                <span>%</span>
                <input type="number" id="porcentaje_promocion" name="porcentaje_promocion" min="0" max="100" step="0.01">
                

                <?php 
                   if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $nota_regular = clean_input($_POST["nota_regular"]);
                        $nota_promocion = clean_input($_POST["nota_promocion"]); 
                        $porcentaje_regular = clean_input($_POST["porcentaje_regular"]);
                        $porcentaje_promocion = clean_input($_POST["porcentaje_promocion"]);
                        
                        $CUE=$_SESSION["instituto"];
                        $ram=new RAM($CUE, $nota_regular, $nota_promocion, $porcentaje_regular, $porcentaje_promocion);
                        $checkeo=$ram->checkear_ram($conn);
                        if($checkeo){
                            echo 'La materia ya se encuentra registrada o ya existe una materia con ese codigo de materia registrado.';
                        }else{
                            $materia->subirMateria($conn);
                            $checkear_materia=$materia->checkear_materia($conn);
                            if($checkear_materia){
                                echo '<p> Se ha agregado la materia correctamente </p>';   
                            }else{
                                echo '<p> No se pudo agregar la materia</p>';
                            } 
                        }
                    }  
                ?>
                <div>
                    <button type="submit">Subir Ram</button>
                </div>

                
            </form>
        </div>
        
   </header>
    
</body>
</html>
