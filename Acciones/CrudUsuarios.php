<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
Class Obtener{
        public static function ObtenerUsuarios(){
            $conectar=Conexion::getInstance()->getConexion();
            $select="SELECT * FROM usuarios";
            $resultado=$conectar->prepare($select);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo(json_encode($data));
        }
        public static function ObtenerById($cedula){
            $bd = Conexion::getInstance()->getConexion();
            $id = $cedula;
            $array = array();
            $resultado = $bd->query("SELECT * FROM usuarios WHERE cedula = '$id'");

            while ($row = $resultado->fetch()) {
                $e = array();
                $e["nombre"] = $row[0];
                $e["apellido"] = $row[1];
                $e["cedula"] = $row[2];
                $e["email"] = $row[3];
                $e["password"] = $row[4];
                $e["rol"] = $row[5];
                $e["fecha_ingreso"] = $row[6];
                array_push($array, $e);
            }
            echo json_encode($array);
        }
    }
    Class Guardar{
        public static function GuardarUsuario()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $conectar = Conexion::getInstance()->getConexion();
        if ($data !== null) {
            $cedula = $data["cedula"];
            $nombre = $data["nombre"];
            $apellido = $data["apellido"];
            $email = $data["email"];
            $rol = $data["rol"];
            $psswd = $data["psswd"];

        }

        $insertarSql = "INSERT INTO usuarios(cedula,nombre,apellido,email,rol, psswd)VALUES('$cedula','$nombre','$apellido','$email','$rol','$psswd')";
        $resultado = $conectar->prepare($insertarSql);
        $resultado->execute();
        //$conectar->commit();
    }
    }
    class Actualizar{
        public static function ActualizarUsuario($id){
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $conectar = Conexion::getInstance()->getConexion();
            if ($data !== null) {
                $email = $data["email"];
                $rol = $data["rol"];
            }

            $updatesql = "UPDATE usuarios  set email= '$email',rol= '$rol' Where id='$id'";
            $resultado = $conectar->prepare($updatesql);
            $resultado->execute();
            echo json_encode($resultado);
            //$conectar->commit();
        }
    }  
    class Eliminar{
        public static function BorrarUsuario($id)
        {
            $conectar = Conexion::getInstance()->getConexion();
            $borrarSQL = "DELETE FROM usuarios WHERE id ='$id'";
            $resultado = $conectar->prepare($borrarSQL);
            $resultado->execute();
            //$conectar->commit();
            if ($resultado->rowCount() > 0) {
                echo json_encode("Se eliminaron: " . $resultado->rowCount() . " registros");
            } else {
                echo json_encode(false);
            }
        }
    }
?>
