<?php 

class Asistencia{
    public $codigo_materia;
    public $DNI_alumno;
    public $fecha;

    public function __construct($codigo_materia,$DNI_alumno,$fecha){
        $this->codigo_materia=$codigo_materia;
        $this->DNI_alumno=$DNI_alumno;
        $this->fecha=$fecha;
    }

    public function tomar_asistencia($conn){
       
        $consulta='INSERT
        INTO asistencia
        (codigo_materia,DNI_alumno,fecha)
        VALUES (:codigo_materia,:DNI_alumno,:fecha)';

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':codigo_materia',$this->codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(':DNI_alumno',$this->DNI_alumno,PDO::PARAM_INT);
        $stmt->bindparam(':fecha',$this->fecha);
        $stmt->execute();

    }

    public static function verificar_asistencia($conn, $DNI_alumno, $codigo_materia){
        $fecha=new DateTime();
        $consulta='SELECT DNI_alumno
        INTO asistencia
        WHERE DNI_alumno=:DNI_alumno and codigo_materia=:codigo_materia and fecha=:fecha';

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':DNI_alumno',$DNI_alumno,PDO::PARAM_INT);
        $stmt->bindparam(':codigo_materia',$codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(':fecha',$fecha);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
        
    }
}