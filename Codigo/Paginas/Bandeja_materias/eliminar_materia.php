<?php
    require_once "../../Clases/conexion.php";
    require_once "../../Clases/Materia.php";
    require_once "../../Clases/Profesor_Instituto.php";
    require_once "../../Clases/Instituto.php";
    $database = new Database();
    $conn = $database->connect();
    session_start();

    function clean_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    $CUE = $_SESSION['instituto'];
    $profesor = $_SESSION['profesor'];
    $legajo = $_SESSION['profesor.legajo'];
    $instituto=Instituto::buscarInstituto($conn,$CUE);
    $_SESSION['instituto.nombre']=$instituto["nombre"];
    $buscar_asignacion=Profesor_Instituto::buscar_asignacion($conn,$CUE,$legajo);
    $id_asignacion=$buscar_asignacion["id"];
    $materias=Materia::buscarMaterias($conn,$id_asignacion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/CSS/formulario.css">
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
            <a href="../Bandeja_institutos/index_institutos.php">Inicio</a>
            <a href="../../index.php">Cerrar Sesión</a>
        </nav>

    </div>
    <div class="image"></div>
    <header class="header">

        <div class="bandeja">
            <div class="interactivos">
                <a href="index_materias.php" >Volver</a>
            </div>

            <form id="formulario" name="eliminar_materia" action="eliminar_materia.php" method="post">
            <h3>Eliminar Materia</h3>
                <label for="materia">Seleccione la materia que desea eliminar</label>
                <select name="codigo_materia" required>
                    <?php
                    foreach($materias as $materia){
                        echo '<option name="codigo_materia" value="'.$materia['codigo_materia'].'">' . $materia['nombre'] . '</option>';
                    }
                    ?>
                </select>

                <?php 
                    if($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $codigo_materia = clean_input($_POST["codigo_materia"]);
                        Materia::eliminar_materia($conn,$codigo_materia);
                        $check=Materia::checkear_materia($conn,$codigo_materia);
                        if(!$check){
                            echo '<p>La materia ha sido eliminada correctamente</p>';
                        }else{
                            echo '<p>La materia no pudo ser eliminada</p>';
                        }
                    }
                ?>
                <div>
                    <button type="submit">Eliminar Materia</button>
                </div>
                <div>
                <?php echo '<p> Ten en cuenta que estas eliminando esta materia perteneciente <br> al instituto  ' . $_SESSION["instituto.nombre"] .',  al eliminarla también se elimina toda la<br> información de sus alumnos dentro de dicha materia.</p>';?>
                </div>

                
            </form>
        </div>
        
   </header>
    
</body>
</html>



