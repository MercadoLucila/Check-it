<?php
require_once 'Clases/Usuario.php';
require_once 'Clases/conexion.php';
require_once 'Clases/Profesor.php';
$database = new Database();
$conn = $database->connect();

function clean_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

if ($_SERVER ["REQUEST_METHOD"] == "POST"){
    $email = clean_input($_POST['email']);
    $clave = clean_input($_POST['clave']);

    $usuario = new Usuario($email,$clave,'','','');
    $verificar_usuario=$usuario->verificarUsuario($conn);
    if($verificar_usuario){
        $verificar_contraseña=$usuario->verificarClave($conn);
        if ($verificar_contraseña){
            $profesor=Profesor::profesorIniciaSesion($conn,$email);
            if($profesor){
                session_start();
                $_SESSION['profesor']=$profesor;
                header('location:/Paginas/Bandeja_Principal/bandeja.php');
                exit();
            }
        }else{
            echo json_encode('clave incorrecta, intente nuevamente');
        }
    }else{
        echo json_encode('El correo ingresado no está relacionado con ningún usuario existente.');
    }

}


