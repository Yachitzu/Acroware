<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Sesion.php');
Class Obtener{
    public static function ObtenerUsuarios(){
        $conectar=Conexion::getInstance()->getConexion();
        $select="SELECT * FROM usuarios";
        $resultado=$conectar->prepare($select);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo(json_encode($data));
    }
        public static function ObtenerById($id){
            $bd = Conexion::getInstance()->getConexion();
            $id = $id;
            $array = array();
            $resultado = $bd->query("SELECT * FROM usuarios WHERE id = '$id'");

            while ($row = $resultado->fetch()) {
                $e = array();
                $e["nombre"] = $row[1];
                $e["apellido"] = $row[2];
                $e["cedula"] = $row[3];
                $e["email"] = $row[4];
                $e["password"] = $row[5];
                $e["rol"] = $row[6];
                $e["fecha_ingreso"] = $row[7];
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
        public static function ActualizarPerfil($id){
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $conectar = Conexion::getInstance()->getConexion();
            if ($data !== null) {
                $nombre = htmlspecialchars($data["nombre"]);
                $apellido = htmlspecialchars($data["apellido"]);
                $cedula = htmlspecialchars($data["cedula"]);
                $email = htmlspecialchars($data["correo"]);
            }

            $updatesql = "UPDATE usuarios  SET email= '$email',nombre= '$nombre',apellido= '$apellido',cedula= '$cedula' WHERE id='$id'";
            $resultado = $conectar->prepare($updatesql);
            $resultado->execute();
            Sesion::getInstance()->setSesion("email", $email);
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['cedula'] = $cedula;
            $_SESSION['correo'] = $email;
            echo json_encode($_SESSION['nombre']);
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
