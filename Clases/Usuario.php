<?php

class Usuario {
    public $email;
    public $clave;
    public $nombre;
    public $apellido;
    public $nacimiento;

    public function __construct($email, $clave, $nombre, $apellido, $nacimiento){
        $this->email=$email;
        $this->clave=$clave;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->nacimiento=$nacimiento;
    }

    public function subirUsuario($conn){
        $hash_clave= password_hash($this->clave,PASSWORD_DEFAULT);
        $consulta_subir="INSERT INTO usuario (email,clave,nombre,apellido,nacimiento)
        VALUES (:email,:clave,:nombre,:apellido,:nacimiento)";

        $subir_usuario = $conn->prepare($consulta_subir);
        $subir_usuario->bindparam(":email",$this->email,PDO::PARAM_STR);
        $subir_usuario->bindparam(":clave",$hash_clave);
        $subir_usuario->bindparam(":nombre",$this->nombre,PDO::PARAM_STR);
        $subir_usuario->bindparam(":apellido",$this->apellido,PDO::PARAM_STR);
        $subir_usuario->bindparam(":nacimiento",$this->nacimiento);
        $subir_usuario->execute();
        
    }

    public function editarUsuario($conn){
        
    }

    public function eliminarUsuario($conn){

    }

    public function verificarUsuario($conn){
        $consulta_verif="SELECT * FROM usuario WHERE (email=:email)";

        $verif_usuario=$conn->prepare($consulta_verif);
        $verif_usuario->bindparam(':email',$this->email,PDO::PARAM_STR);
        $verif_usuario->execute();
        $row=$verif_usuario->fetch(PDO::FETCH_ASSOC);

        if($row){
            return true;
        }else{
            return false;
        }
    }

    public function verificarClave($conn){
        $consulta_clave="SELECT * FROM usuario WHERE (email=:email)";

        $verificar_clave=$conn->prepare($consulta_clave);
        $verificar_clave->bindparam(':email',$this->email,);
        $verificar_clave->execute();
        $row=$verificar_clave->fetch(PDO::FETCH_ASSOC);

        if($row){
            if(password_verify($this->clave,$row['clave'])){
                return true;
            }else{
                return false;
            }
        }
    }
}