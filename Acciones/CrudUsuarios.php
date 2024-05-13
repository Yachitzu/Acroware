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
        public static function GuardarUsuario(){
            $conectar = Conexion::getInstance()->getConexion();
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $cedula=$_POST["cedula"]; //los que estan en "" sonlos nombres de los objetos de el html
            $email=$_POST["email"];
            $password=$_POST["password"];
            $rol=$_POST["rol"];
            $fecha_ingreso=$_POST["fecha_ingreso"];

            $insertarSql="INSERT INTO usuarios(nombre,apellido,cedula,email,`password`, rol, fecha_ingreso)VALUES('$nombre','$apellido','$cedula','$email','$password','$rol','$fecha_ingreso')";
            $resultado=$conectar->prepare($insertarSql);
            $resultado->execute();
            $conectar->commit();
        }
    }
?>
