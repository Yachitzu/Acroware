<?php
header("Access-Control-Allow-Origin:http://localhost:19006");

require_once "conexion.php";
    Class Obtener{
        public static function ObtenerUsuario(){            
            $objeto=new Conexion();
            $conectar=$objeto->conectar();
            $select="SELECT * FROM usuarios";
            $resultado=$conectar->prepare($select);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo(json_encode($data));
        }
        public static function ObtenerById($cedula){
            $bd = new Conexion();
            $bd = $bd->conectar();
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
            
            $objeto=new Conexion();
            $conectar=$objeto->conectar();
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
    class Eliminar{
        public static function BorrarEstudiantes($cedula){
            $objeto = new Conexion();
            $conectar = $objeto->conectar();
            $borrarSQL = "DELETE FROM usuarios WHERE cedula='$cedula'";
            $resultado = $conectar->prepare($borrarSQL);
            $resultado->execute();
            $conectar->commit();
            if ($resultado->rowCount() > 0) {
                echo json_encode("Se eliminaron: " . $resultado->rowCount() . " registros");
            } else {
                echo json_encode(false);
            }
        }
    }
    class Actualizar{
        public static function ActualizarUsuario($cedula,$nombre,$apellido,$password){
            $objeto = new Conexion();
            $conectar = $objeto->Conectar();
    
            $updatesql = "UPDATE usuarios  set nombre= '$nombre',apellido= '$apellido', 
            password= '$password' Where cedula='$cedula'";
            $resultado = $conectar->prepare($updatesql);
            $resultado->execute();
            echo json_encode($resultado);
            $conectar->commit();    
        }
    }     

?>