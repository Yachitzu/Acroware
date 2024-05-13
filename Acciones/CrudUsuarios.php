<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
Class Obtener{
        public static function ObtenerUsuarios(){            
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
?>
