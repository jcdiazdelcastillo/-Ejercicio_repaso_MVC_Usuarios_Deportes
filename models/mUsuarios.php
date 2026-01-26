<?php
    require_once __DIR__ . "/../controllers/conexion.php";

    class MUsuarios extends Conexion{

        public function introducirUsuarios($nombreUsuario, $nombreApellido, $pw, $email, $telefono){
            
            try{
                $sql = "INSERT INTO usuarios (nombreUsuario, apeNombre, pw, correo, telefono, perfil) VALUES(:nombreUsuario, :nombreApellido, :pw, :email, :telefono, :perfil)";
                $stmt=$this->conexion->prepare($sql);

                // Los placeholders :nombre, :contrasenia, :email, :tipo se reemplazan por los valores reales pasados por parámetros. Se dice su tipo de dato

                $stmt->bindValue(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
                $stmt->bindValue(':nombreApellido', $nombreApellido, PDO::PARAM_STR);
                $stmt->bindValue(':pw', $pw, PDO::PARAM_STR);
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->bindValue(':telefono', $telefono, PDO::PARAM_STR);
                $stmt->bindValue(':perfil', "u", PDO::PARAM_STR);

                /*la ejecución*/
                // Devuelve true si la inserción fue correcta, false si falló
                $stmt->execute();
                return $this->conexion->lastInsertId();

            }catch(PDOException $e){
                return $e->getMessage();
                //return false;
            }
            
        }

        public function inscripcion_usuario_deportes($idUsuario, $idDeporte){
            try{
                $this->conexion->beginTransaction();

                $sql = "INSERT INTO usuarios_deportes (idUsuario, idDeporte) VALUES(:idUsuario, :idDeporte)";
                $stmt=$this->conexion->prepare($sql);

                $stmt->bindValue(':idUsuario', (int)$idUsuario, PDO::PARAM_INT);
                $stmt->bindValue(':idDeporte', (int)$idDeporte, PDO::PARAM_INT);

                
                 $stmt->execute();
                 // Todo OK
                $this->conexion->commit();

                return true;
            }catch(PDOException $e){
                $this->conexion->rollback(); // DESHACEMOS la transacción si falla

                return $e->getMessage(); 
              //  return false;
            }
        }

        public function iniciarSesion($email, $pw){
            try{
                $sql = "SELECT * FROM usuarios WHERE correo=:correo AND pw=:pw";
                $stmt=$this->conexion->prepare($sql);
                $stmt->bindValue(':correo', $email, PDO::PARAM_STR);
                $stmt->bindValue(':pw', $pw, PDO::PARAM_STR);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);

            }catch(PDOException $e){
                return $e->getMessage();
            }
            
        }

        public function getDeportesUsuarios() {
            try {
                $sql = " SELECT usuario.nombreUsuario, usuario.apeNombre, deporte.nombreDep
                    FROM usuarios usuario
                    INNER JOIN usuarios_deportes ud ON usuario.idUsuario = ud.idUsuario
                    INNER JOIN deportes deporte ON ud.idDeporte = deporte.idDeporte
                    ORDER BY usuario.idUsuario
                ";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        public function getTotalDeportes() {
            try {
                $sql = "SELECT COUNT(DISTINCT idDeporte) AS total_deportes FROM usuarios_deportes";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        public function getTotalUsuariosDeporte() {
            try {
                $sql = "
                    SELECT deporte.nombreDep, COUNT(ud.idUsuario) AS total_usuarios
                    FROM deportes deporte
                    LEFT JOIN usuarios_deportes ud ON deporte.idDeporte = ud.idDeporte
                    GROUP BY deporte.idDeporte
                    ORDER BY deporte.nombreDep
                ";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

    }
?>