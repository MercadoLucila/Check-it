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

    public static function obtener_ram($conn, $CUE){
        $consulta="SELECT *
        FROM ram
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$CUE,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }else{
            return $row;
        }
    }

    public static function obtener_estado($conn,$CUE,$calificaciones,$promedio_asistencia){
        $consulta="SELECT *
        FROM ram
        WHERE CUE=:CUE";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":CUE",$CUE,PDO::PARAM_STR);
        $stmt->execute();
        $ram=$stmt->fetch(PDO::FETCH_ASSOC);

        $calificacion_libre=false;
        $calificacion_regular=false;
        $calificacion_promocion=false;

        foreach($calificaciones as $calificacion){
            if($calificacion<$ram["nota_regular"] || $calificacion==""){ //Si tiene al menos una calificacion menor a la nota regular, ya tiene calificacion libre
                $calificacion_libre=true;
                
            }elseif($calificacion>=$ram["nota_regular"] && $calificacion<$ram["nota_promocion"]){ //Si tiene al menos una calificacion mayor o igual a la nota regular pero menor a la nota de promocion, ya tiene calificacion regular
                $calificacion_regular=true;
            }else{
                $calificacion_promocion=true; //Si no ocurre ninguna de las anteriores, entonces la única opción es que su nota sea mayor o igual a la nota de promoción.
            }
        }

        switch(true){
            case ($calificacion_libre || $promedio_asistencia<$ram["asistencia_regular"] ); // Si tiene al menos una nota por debajo de la nota regular o tiene asistencias por debajo de als asistencias regulares, queda Libre
                $condicion='Libre';
                return $condicion;
                break;
            case ($calificacion_regular && $calificacion_libre==false && $promedio_asistencia<$ram["asistencia_regular"]); //Si tiene al menos una nota regular, no tiene calificaciones libres y tiene asistencia menor a la regular, queda Libre
                $condicion='Libre';
                return $condicion;
                break;
            case ($calificacion_regular && $calificacion_libre==false && $promedio_asistencia>=$ram["asistencia_regular"]); //Si tiene al menos una nota regular, no tiene calificaciones libres y tiene asistencia mayor o igual a la regular, queda Regular
                $condicion='Regular';
                return $condicion;
                break;
            case ($calificacion_promocion && $calificacion_regular==false && $calificacion_libre==false && $promedio_asistencia<$ram["asistencia_promocion"]); //Si tiene todas las notas de promocion, pero asistencia por debajo de la promocion, queda Regular
                $condicion='Regular';
                return $condicion;
                break;
            case ($calificacion_regular==false && $calificacion_libre==false && $promedio_asistencia>=$ram["asistencia_promocion"]); //Si no existe nota regular o nota libre (todas sus notas son de promocion), y asistencia mayor o igual de la promocion, queda Promocionado
                $condicion='Promocionado';
                return $condicion;
                break;
            case(!$ram); //Si no existe ram, devuelve la condicion "Sin Ram" que da a entender que para determinar la condicion es necesario que establezca la ram 
                $condicion='Sin ram';
                return $condicion;
                break;
                
            


        }
    }
}