<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
Class Obtener{
        public static function ObtenerSoftware(){
            $conectar=Conexion::getInstance()->getConexion();
            $select="SELECT * FROM software";
            $resultado=$conectar->prepare($select);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo(json_encode($data));
        }
        public static function ObtenerById($id){
            $bd = Conexion::getInstance()->getConexion();
            $id = $id;
            $array = array();
            $resultado = $bd->query("SELECT * FROM software WHERE id = '$id'");

            while ($row = $resultado->fetch()) {
                $e = array();
                $e["id"] = $row[0];
                $e["nombre_software"] = $row[1];
                $e["proveedor"] = $row[2];
                $e["tipo_licencia"] = $row[3];
                $e["activado"] = $row[4];
                $e["fecha_adqui"] = $row[5];
                array_push($array, $e);
            }
            echo json_encode($array);
        }
    }
?>
