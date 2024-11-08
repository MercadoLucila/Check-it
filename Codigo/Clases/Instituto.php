<?php

class Instituto{
    public $CUE;
    public $nombre;
    public $descripcion;
    public $nivel;
    public $direccion;

    public function __construct($CUE, $direccion, $descripcion, $nivel, $nombre){
        $this->CUE=$CUE;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->nivel=$nivel;
        $this->direccion=$direccion;
    }

    public function subirInstituto($conn){
        $consulta="INSERT
        INTO instituto
        (nombre,CUE,descripcion,nivel,direccion)
        VALUES (:nombre, :CUE, :descripcion, :nivel, :direccion)";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':nombre',$this->nombre, PDO::PARAM_STR);
        $stmt->bindparam(':CUE',$this->CUE,PDO::PARAM_INT);
        $stmt->bindparam(':descripcion',$this->descripcion,PDO::PARAM_STR);
        $stmt->bindparam(':nivel',$this->nivel,PDO::PARAM_STR);
        $stmt->bindparam(':direccion',$this->direccion,PDO::PARAM_STR);
        $stmt->execute();

    }

    public function editarInstituto($conn){
        $consulta="UPDATE instituto
        SET nombre=:nombre, descripcion=:descripcion, nivel=:nivel, direccion=:direccion
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':nombre',$this->nombre, PDO::PARAM_STR);
        $stmt->bindparam(':CUE',$this->CUE,PDO::PARAM_INT);
        $stmt->bindparam(':descripcion',$this->descripcion,PDO::PARAM_STR);
        $stmt->bindparam(':nivel',$this->nivel,PDO::PARAM_STR);
        $stmt->bindparam(':direccion',$this->direccion,PDO::PARAM_STR);
        $stmt->execute();

    }

    public static function eliminarInstituto($conn,$CUE){
        $consulta= "DELETE 
        FROM instituto
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$CUE,PDO::PARAM_INT);
        $stmt->execute();
        
    }

    public function corroborarInstituto($conn){
        $consulta="SELECT *
        FROM instituto
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':CUE',$this->CUE,PDO::PARAM_INT);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$row){
            return false;
        }else{
            return true;
        }
    }

    public static function buscarInstitutos($conn,$legajo){
        $busqueda_instituto=
        "SELECT *
        FROM instituto
        JOIN profesor_instituto ON instituto.CUE = profesor_instituto.CUE;";

        $stmt=$conn->query($busqueda_instituto);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC); 

        $institutos=[];
        foreach($row as $tupla){
            if($tupla["legajo"]==$legajo){
                array_push($institutos,$tupla);
            }
        }

        if(!$institutos){
            return false;
        }else{
            return $institutos;
        }


    }

    public static function buscarInstituto($conn, $CUE){
        $busqueda_instituto=
        "SELECT instituto.nombre
        FROM instituto
        WHERE CUE = :CUE";

        $stmt=$conn->prepare($busqueda_instituto);
        $stmt->bindparam(":CUE",$CUE,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}