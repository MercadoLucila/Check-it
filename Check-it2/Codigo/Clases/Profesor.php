<?php

class Profesor extends Usuario{
    public $legajo;
    public $sexo;

    public function __construct($email, $clave, $nombre, $apellido, $nacimiento, $legajo, $sexo){
        parent::__construct($email, $clave, $nombre, $apellido, $nacimiento);
        $this->legajo=$legajo;
        $this->sexo=$sexo;
    }

    public function subirProfesor($conn){
        $clave= password_hash($this->clave,PASSWORD_DEFAULT);
        $consulta="INSERT INTO profesor
        (email, clave, nombre, apellido, nacimiento, legajo, sexo)
        VALUES (:email, :clave, :nombre, :apellido, :nacimiento, :legajo, :sexo)";

        $subir=$conn->prepare($consulta);
        $subir->bindparam(':email',$this->email,PDO::PARAM_STR);
        $subir->bindparam(':clave',$clave);
        $subir->bindparam(':nombre',$this->nombre,PDO::PARAM_STR);
        $subir->bindparam(':apellido',$this->apellido,PDO::PARAM_STR);
        $subir->bindparam(':nacimiento',$this->nacimiento);
        $subir->bindparam(':legajo',$this->legajo,PDO::PARAM_INT);
        $subir->bindparam(':sexo',$this->sexo,PDO::PARAM_STR);
        $subir->execute();

    }

    public function editarProfesor($conn){

    }

    public function eliminarProfesor($conn){
        
    }

    public static function profesorIniciaSesion($conn,$email){
        $consulta="SELECT *
        FROM profesor
        WHERE email=:email";

        $buscar=$conn->prepare($consulta);
        $buscar->bindparam(':email',$email,PDO::PARAM_STR);
        $buscar->execute();
        $row=$buscar->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }else{
            return $row;
        }
    }
        
}