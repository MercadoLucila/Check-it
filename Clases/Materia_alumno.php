<?php

class Materia_Alumno{
    public $codigo_materia;
    public $DNI;

    public function __construct($codigo_materia,$DNI){
        $this->codigo_materia=$codigo_materia;
        $this->DNI=$DNI;
    }

    public function matricularAlumno($conn){
        
    }
}