<?php 

Class Ram {
    public $CUE;
    public $nota_regular;
    public $nota_promocion;
    public $asistencia_regular;
    public $asistencia_promocion;

    public function __construct($CUE, $nota_regular, $nota_promocion, $asistencia_regular, $asistencia_promocion){
        $this->CUE=$CUE;
        $this->nota_regular=$nota_regular;
        $this->nota_promocion=$nota_promocion;
        $this->asistencia_regular=$asistencia_regular;
        $this->asistencia_promocion=$asistencia_promocion;
    }

    public function checkear_ram($conn){
        $consulta="SELECT *
        FROM ram
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$this->CUE,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            return true;
        }else{
            return false;
        }
    }

    public function subir_ram($conn){
        $consulta="INSERT
        INTO ram
        (CUE, nota_regular, nota_promocion, asistencia_regular, asistencia_promocion)
        VALUES (:CUE, :nota_regular, :nota_promocion, :asistencia_regular, :asistencia_promocion)";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$this->CUE,PDO::PARAM_STR);
        $stmt->bindparam(":nota_regular",$this->nota_regular,PDO::PARAM_INT);
        $stmt->bindparam(":nota_promocion",$this->nota_promocion,PDO::PARAM_INT);
        $stmt->bindparam(":asistencia_regular",$this->asistencia_regular,PDO::PARAM_INT);
        $stmt->bindparam(":asistencia_promocion",$this->asistencia_promocion,PDO::PARAM_INT);
        $stmt->execute();
        
    }

    public function editar_ram($conn){
        $consulta="UPDATE ram
        SET nota_regular = :nota_regular, nota_promocion = :nota_promocion, asistencia_regular = :asistencia_regular, asistencia_promocion = :asistencia_promocion
        WHERE CUE = :CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$this->CUE,PDO::PARAM_STR);
        $stmt->bindparam(":nota_regular",$this->nota_regular,PDO::PARAM_INT);
        $stmt->bindparam(":nota_promocion",$this->nota_promocion,PDO::PARAM_INT);
        $stmt->bindparam(":asistencia_regular",$this->asistencia_regular,PDO::PARAM_INT);
        $stmt->bindparam(":asistencia_promocion",$this->asistencia_promocion,PDO::PARAM_INT);
        $stmt->execute();
        
    }

    public function eliminar_ram($conn){
        $consulta="DELETE
        FROM ram
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$this->CUE,PDO::PARAM_STR);
        $stmt->execute(); 
    }
}