<?php

class Profesor_Instituto{
    public $legajo;
    public $CUE;

    public function __construct($legajo,$CUE){
        $this->legajo=$legajo;
        $this->CUE=$CUE;  
    }

    public static function buscar_asignacion($conn, $CUE, $legajo){
        $consulta = "SELECT *
        FROM profesor_instituto
        WHERE CUE=:CUE and legajo=:legajo";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':CUE',$CUE);
        $stmt->bindparam(':legajo',$legajo);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
            return $row["id"];
        
    }

    public function subir_profesor_instituto($conn){
        $consulta = "INSERT
        INTO profesor_instituto
        (CUE,legajo)
        VALUES (:CUE, :legajo)";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':CUE',$this->CUE,PDO::PARAM_STR);
        $stmt->bindparam(':legajo',$this->legajo);
        $stmt->execute();
    }

    public function checkear_profesor_instituto($conn){
        $consulta = "SELECT *
        FROM profesor_instituto
        WHERE CUE=:CUE and legajo=:legajo";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':CUE',$this->CUE,PDO::PARAM_STR);
        $stmt->bindparam(':legajo',$this->legajo,PDO::PARAM_INT);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
           return true;   
        }else{
            return false;
        }
    }


}