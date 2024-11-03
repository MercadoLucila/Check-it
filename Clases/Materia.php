<?php

class Materia{
    public $codigo_materia;
    public $nombre;
    public $id_asignacion;

    public function __construct($codigo_materia,$nombre,$id_asignacion){
        $this->codigo_materia=$codigo_materia;
        $this->nombre=$nombre;
        $this->id_asignacion=$id_asignacion;
    }

    public function subirMateria($conn){
        $consulta="INSERT
        INTO materia
        (codigo_materia,id_asignacion,nombre)
        VALUES (:codigo_materia,:id_asignacion,:nombre)";

        $stmt = $conn->prepare($consulta);
        $stmt->bindparam(':codigo_materia',$this->codigo_materia,PDO::PARAM_STR);
        $stmt->bindparam(':id_asignacion',$this->id_asignacion,PDO::PARAM_INT);
        $stmt->bindparam(':nombre',$this->nombre,PDO::PARAM_STR);
        $stmt->execute();
    }

    public function editarMateria($conn){

    }

    public function eliminarMateria($conn){
        $consulta="DELETE
        FROM materia
        WHERE codigo_materia=:codigo_materia";

        $stmt = $conn->prepare($consulta);
        $stmt->bindparam(':codigo_materia',$this->codigo_materia,PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function buscarMaterias($conn,$id_asignacion){
        $consulta="SELECT *
        FROM materia
        WHERE id_asignacion=:id_asignacion";

        $buscar = $conn->prepare($consulta);
        $buscar->bindparam(':id_asignacion',$id_asignacion,PDO::PARAM_INT);
        $buscar->execute();
        return $buscar->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkear_materia($conn){
        $consulta="SELECT *
        FROM materia
        WHERE codigo_materia=:codigo_materia";

        $stmt = $conn->prepare($consulta);
        $stmt->bindparam(':codigo_materia',$this->codigo_materia,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$row){
            return false;
        }else{
            return true;
        }
    }
}