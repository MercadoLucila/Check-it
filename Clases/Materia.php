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

    }

    public function editarMateria($conn){

    }

    public function eliminarMateria($conn){
        
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
}