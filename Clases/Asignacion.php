<?php

class Asignacion{
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
}