<?php
//AGREGAR MATERIA
    require_once '../../Clases/conexion.php';
    require_once '../../Clases/Materia.php';
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

    <title>Check-it Agregar Materia</title>
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

        <div class="bandeja">
            <div class="interactivos">
                <a href="index_materias.php" >Volver</a>
            </div>

            <h3>Agregar Materia</h3>

            <form id="formulario" name="subir_materia" action="agregar_materia.php" method="post">
                <label for="nombre">Nombre de la materia</label>
                <input id="nombre" name="nombre" type="text" required>

                <label for="codigo_materia">Codigo de la materia</label>
                <input id="codigo_materia" name="codigo_materia" type="text" required>


                <?php 
                    if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $nombre = clean_input($_POST["nombre"]); 
                        $codigo_materia = clean_input($_POST["codigo_materia"]);
                        var_dump($codigo_materia);
                        
                        $profesor=$_SESSION["profesor"];
                        $legajo=$profesor["legajo"];
                        $CUE=$_SESSION["instituto"];

                        $id_asignacion=Profesor_Instituto::buscar_asignacion($conn,$CUE,$legajo);
                        var_dump($id_asignacion);
                        $materia=new Materia($codigo_materia,$nombre,$id_asignacion);
                        $checkeo=$materia->checkear_materia($conn);
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
                    <button type="submit">Agregar Materia</button>
                </div>
                <div>
                <?php echo '<p> Ten en cuenta que estas agregando esta materia en el instituto ' . $_SESSION["instituto.nombre"] .', </p>
                <p> en caso de que crees una materia en un instituo equivocado, </p>
                <p> luego puedes eliminarla dentro de las opciones de edicion de materia.</p>';?>
                </div>

                
            </form>
        </div>
        
   </header>
    
</body>
</html>


