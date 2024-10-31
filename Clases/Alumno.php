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
}
