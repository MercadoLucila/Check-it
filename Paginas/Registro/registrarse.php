<?php
require_once '../../Clases/Usuario.php';
require_once '../../Clases/conexion.php';
require_once '../../Clases/Profesor.php';
$database= new Database();
$conn=$database->connect();

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
    <link rel="stylesheet" href="../../Resources/CSS/style_registrarse.css">
    <link rel="icon" href="../../Resources/imagenes/Logo.ico">
    <script src="../../Resources/JS/fn_registro.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Check-it Registrarse</title>
</head>
<body>
    <div class="head">

        <div class="logo">
            <a href="../../index.php"> <img class="loguito" src="/Resources/imagenes/checkit-logoletras.png" alt="Logo Checkit"> </a>
        </div>

        <nav class="navbar">
            <a href="../../index.php">Inicio</a>
            <a href="#">Contacto</a>
            <a href="#">QA</a>
        </nav>

    </div>

    <div class="image"></div>
   <header class="header">
        <div>
            <h2 class="titulo">Bienvenido Profe!</h2>
            <p>
                Estás a solo un paso de agilizar tu proceso de asistencia.
                ¡Tomar asistencia nunca fue tan fácil como con check-it!
                
            </p>

        </div>
        

        <div class="form">
            <h3>Registrarse</h3>
            <form id="registro" name="2" action="registrarse.php" method="post">

                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" required>

                <label for="apellido">Apellido</label>
                <input id="apellido" name="apellido" type="text" required>

                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" required>

                <label for="nacimiento">Fecha de nacimiento</label>
                <input id="nacimiento" name="nacimiento" type="date" required>

                <label for="legajo">Legajo</label>
                <input id="legajo" name="legajo" type="number" required>

                <div class="opciones">
                    <h4 >Sexo</h4>
                    <label for="sexo">
                    <input id="sexo" name="sexo" type="radio" value="F" required>    
                    Femenino
                    </label>

                    <label for="sexo">
                    <input id="sexo" name="sexo" type="radio" value="M" required>    
                    Masculino
                    </label>

                    <label for="sexo">
                    <input id="sexo" name="sexo" type="radio" value="N" required>    
                    Otro
                    </label>

                </div>
                
                <label for="clave">Contraseña</label>
                <input id="clave" name="clave" type="password" required>

                <label for="clave2">Contraseña</label>
                <input id="clave2" name="clave2" type="password" required>
                <?php
                    if ($_SERVER ["REQUEST_METHOD"] == "POST"){
                        $email = clean_input($_POST['email']);
                        $nombre = clean_input($_POST['nombre']);
                        $apellido = clean_input($_POST['apellido']);
                        $legajo = clean_input($_POST['legajo']);
                        $sexo = clean_input($_POST['sexo']);
                        $nacimiento = clean_input($_POST['nacimiento']);
                        $clave = clean_input($_POST['clave']);

                        $usuario = new Usuario($email, $clave, $nombre, $apellido, $nacimiento);
                        $profesor = new Profesor($email,$clave,$nombre,$apellido,$nacimiento,$legajo,$sexo);
                        $verificar_usuario=$usuario->verificarUsuario($conn);
                        if($verificar_usuario==false){
                            $subir_usuario=$usuario->subirUsuario($conn);
                            $subir_profesor=$profesor->subirProfesor($conn);
                            if($usuario->verificarUsuario($conn)){
                                echo "<p>Has sido registrado con éxito.</p>";
                            }else{
                                echo "<p>Hubo un error</p>";
                            }
                    }else{
                        echo "<p>El correo ingresado ya fue empleado para crear otro usuario, intente con otro correo.</p>";
                    }}
                ?>

                <div>
                    <input type="button" onclick="verificar_datos()" value="Registrarse">
                </div>
                    
            </form>
        </div>
   </header>
    
</body>
</html>