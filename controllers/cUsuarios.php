<?php
   // require_once __DIR__ . "/conexion.php";
   require_once __DIR__ . "/../models/mUsuarios.php";

    class CUsuarios extends Conexion{
        public $vista;
        public $mensaje;
        public $modelo;

        function __construct()
        {
            $this->vista="";
            $this->mensaje=null;
            $this->modelo = new MUsuarios();
        }

        public function vistaInicial(){
            $this->vista="inicio.php";
        }


        public function inscripcionUsuarios(){
            $this->vista="validarAlta.php";
            var_dump($_POST);
            if(!empty($_POST["nombreUsuario"]) && !empty($_POST["nombreApellidos"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && isset($_POST["deportes"]) && isset($_POST["condiciones"])){
                $nombreUsuario=$_POST["nombreUsuario"];
                $nombreApellidos = $_POST["nombreApellidos"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                $telefono = $_POST["telefono"];
                $deportes = $_POST["deportes"];

                $resultado = $this->modelo->introducirUsuarios($nombreUsuario, $nombreApellidos, $password, $email, $telefono);
                if(is_numeric($resultado)){ //$resultado es numero por last insert id
                    $idUsuario = $resultado; 
                    $resultadoDeporte = true;
                    foreach($deportes as $deporte){
                        if($resultadoDeporte){
                            $resultadoDeporte = $this->modelo->inscripcion_usuario_deportes($idUsuario, $deporte);
                        }
                    }
                    if(!is_string($resultadoDeporte)){
                        $this->mensaje="Inscripción realizada de manera correcta";
                    }else{
                        $this->mensaje="Error al realizar la inscripcion".$resultadoDeporte;
                    }
                }else{ //si el resultado no es numerico es un string con la excepción
                    $this->mensaje="ERROR AL REALIZAR EL ALTA DEL USUARIO ".$resultado;
                }
            }else{
                $this->mensaje="Faltan datos obligatorios";
            }
        }

        public function cargarInicioSesion(){
            $this->vista="form_inicio_sesion.php";
        }

        public function iniciarSesion(){
            session_start();
            $this->vista="panel_principal.php";
            if(isset($_POST["email"]) && isset($_POST["password"])){
                $email=$_POST["email"];
                $password=$_POST["password"];
                $resultado=$this->modelo->iniciarSesion($email, $password);

                if(is_array($resultado)){
                
                    $_SESSION["idUsuario"]=$resultado["idUsuario"];
                    $_SESSION["nombreUsuario"]=$resultado["nombreUsuario"];
                    $_SESSION["perfil"]=$resultado["perfil"];
                }else{
                    if(!$resultado){ //SI EL SELECT no encuentra nada -> FALSE
                        $this->mensaje="USUARIO NO ENCONTRADO";
                    }else{
                        $this->mensaje="ERROR" + $resultado; //EXCEPCIÓN
                    }
                }
            }
        }

        public function obtener_deportes_usuario(){
            $this->vista="visualizarDeportesUsuarios.php";
            $resultado=$this->modelo->getDeportesUsuarios();
            if(is_array($resultado)){
                return $resultado;
            }else{ // si $resultado NO es un array, es un string con la excepción
                $this->mensaje="ERROR, NO SE HAN PODIDO OBTENER LOS DEPORTES DE LOS USUARIOS ".$resultado;
            }
        }

        public function total_deportes(){
            $this->vista="totalDeportes.php";
            $resultado=$this->modelo->getTotalDeportes();
            if(is_array($resultado)){
                return $resultado;
            }else{ // si $resultado NO es un array, es un string con la excepción
                $this->mensaje="ERROR, NO SE HAN PODIDO OBTENER LOS DEPORTES DE LOS USUARIOS ".$resultado;
            }
        }

        public function cerrarSesion(){
            $this->vista = "inicio.php";
            session_start();
            session_destroy();
        }

        public function totalUsuariosDeporte(){
            $this->vista="total_usuarios_deporte.php";
            $resultado=$this->modelo->getTotalUsuariosDeporte();
            if(is_array($resultado)){
                return $resultado;
            }else{ // si $resultado NO es un array, es un string con la excepción
                $this->mensaje="ERROR, NO SE HAN PODIDO OBTENER LOS DEPORTES DE LOS USUARIOS ".$resultado;
            }
        }

    }