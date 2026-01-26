<?php
    require_once __DIR__ . "/../controllers/conexion.php";

    class MDeportes extends Conexion{
        public function sacarDeportes(){
            $sql = "SELECT * FROM deportes";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            // devuelve todas  las filas como array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>