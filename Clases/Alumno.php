<?php

class Alumno{
    public $DNI;
    public $nombre;
    public $apellido;
    public $email;
    public $nacimiento;

    public function __construct($DNI, $nombre, $apellido, $email, $nacimiento){
        $this->DNI=$DNI;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->email=$email;
        $this->nacimiento=$nacimiento;
    }

    public static function eliminarAlumno_Materia($conn, $DNI, $codigo_materia){
        $consulta="DELETE
        FROM materia_alumno
        WHERE DNI = :DNI and codigo_materia = :codigo_materia ";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":DNI",$DNI);
        $stmt->bindparam(":codigo_materia",$codigo_materia);
        $stmt->execute();
        
    }

    public static function buscarAlumnos($conn, $codigo_materia){
        $consulta="SELECT *
        FROM alumno
        INNER JOIN materia_alumno ON alumno.DNI = materia_alumno.DNI
        WHERE materia_alumno.codigo_materia = :codigo_materia";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(":codigo_materia",$codigo_materia);
        $stmt->execute();
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$row){
            return "Aún no hay alumnos en esta materia";
        }else{
            return $row;
        }
    }

    public function corroborarAlumno($conn){
        $consulta="SELECT *
        FROM alumno
        WHERE DNI=:DNI";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':DNI',$this->DNI,PDO::PARAM_INT);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$row){
            return false;
        }else{
            return true;
        }
    }

    public function subirAlumno($conn){
        $consulta="INSERT
        INTO alumno
        ( DNI, nombre, apellido, email, nacimiento)
        VALUES (:DNI, :nombre, :apellido, :email, :nacimiento)";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':DNI',$this->DNI,PDO::PARAM_INT);
        $stmt->bindparam(':nombre',$this->nombre, PDO::PARAM_STR);
        $stmt->bindparam(':apellido',$this->apellido,PDO::PARAM_STR);
        $stmt->bindparam(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindparam(':nacimiento',$this->nacimiento);
        $stmt->execute();

    }

    public function checkearMatricula($conn,$codigo_materia){
        $consulta="SELECT *
        FROM materia_alumno
        WHERE DNI=:DNI and codigo_materia=:codigo_materia";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':DNI',$this->DNI, PDO::PARAM_INT);
        $stmt->bindparam(':codigo_materia',$codigo_materia,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            return true;
        }else{
            return false;
        }

    }

    public function matricularAlumno($conn,$codigo_materia){
        $consulta="INSERT
        INTO materia_alumno
        (DNI,codigo_materia)
        VALUES (:DNI, :codigo_materia)";

        $stmt=$conn->prepare($consulta);
        $stmt->bindparam(':DNI',$this->DNI, PDO::PARAM_INT);
        $stmt->bindparam(':codigo_materia',$codigo_materia,PDO::PARAM_STR);
        $stmt->execute();
    }
}
