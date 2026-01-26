<?php
   // require_once __DIR__ . "/conexion.php";
   require_once __DIR__ . "/../models/mDeportes.php";

    class CDeportes extends Conexion{
        public $vista;
        public $mensaje;
        public $modelo;

        function __construct()
        {
            $this->vista="";
            $this->mensaje=null;
            $this->modelo = new MDeportes();
        }

        public function inscripcion(){
            $this->vista="inscripcion.php";
            $resultado = $this->modelo->sacarDeportes();
            return $resultado;
        }
    }
?>