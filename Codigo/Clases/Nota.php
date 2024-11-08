<?php

class Nota {
    public $codigo_materia;
    public $DNI_alumno;
    public $calificacion;
    public $fecha;
    
    public function __construct($codigo_materia,$DNI_alumno,$calificacion,$fecha){
        $this->codigo_materia=$codigo_materia;
        $this->DNI_alumno=$DNI_alumno;
        $this->calificacion=$calificacion;
        $this->fecha=$fecha;
    }

    public function subir_nota($conn){
        $consulta="INSERT
        INTO notas
        (codigo_materia,DNI_alumno,calificacion,fecha)
        VALUES (:codigo_materia,:DNI_alumno,:calificacion,:fecha)";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$this->codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(":DNI_alumno",$this->DNI_alumno,PDO::PARAM_INT);
        $stmt->bindparam(":calificacion",$this->calificacion,PDO::PARAM_INT);
        $stmt->bindparam(":fecha",$this->fecha);
        $stmt->execute();
    }

    public function checkear_nota($conn){
        $consulta="SELECT *
        FROM notas
        WHERE codigo_materia=:codigo_materia and DNI_alumno=:DNI_alumno and fecha=:fecha";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$this->codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(":DNI_alumno",$this->DNI_alumno,PDO::PARAM_INT);
        $stmt->bindparam(":fecha",$this->fecha);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }else{
            return true;
        }
    }

    public function editar_nota($conn,$calificacion){
        $consulta="UPDATE notas
        SET calificacion = :calificacion
        WHERE codigo_materia=:codigo_materia and DNI_alumno=:DNI_alumno and fecha=:fecha";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$this->codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(":DNI_alumno",$this->DNI_alumno,PDO::PARAM_INT);
        $stmt->bindparam(":calificacion",$calificacion,PDO::PARAM_INT);
        $stmt->bindparam(":fecha",$this->fecha);
        $stmt->execute();
    }

    public function eliminar_nota($conn){
        $consulta="DELETE
        FROM notas
        WHERE codigo_materia=:codigo_materia and DNI_alumno=:DNI_alumno and fecha=:fecha";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$this->codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(":DNI_alumno",$this->DNI_alumno,PDO::PARAM_INT);
        $stmt->bindparam(":fecha",$this->fecha);
        $stmt->execute();
    }

    public static function buscar_nota($conn,$DNI_alumno,$codigo_materia){
        $consulta="SELECT fecha, calificacion 
        FROM notas 
        WHERE DNI_alumno = :DNI_alumno AND codigo_materia = :codigo_materia 
        ORDER BY fecha ASC";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(":DNI_alumno",$DNI_alumno,PDO::PARAM_INT);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public static function calcular_promedio($conn,$DNI_alumno,$codigo_materia){
        $consulta="SELECT 
        SUM(calificacion) AS total_calificaciones, 
        AVG(calificacion) AS promedio 
        FROM notas 
        WHERE DNI_alumno = :DNI_alumno AND codigo_materia = :codigo_materia";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(":DNI_alumno",$DNI_alumno,PDO::PARAM_INT);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

}