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
    Class Guardar{
        public static function GuardarSoftware()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $conectar = Conexion::getInstance()->getConexion();
        if ($data !== null) {
            $nombre_software = $data["nombre_software"];
            $proveedor = $data["proveedor"];
            $tipo_licencia = $data["tipo_licencia"];
            $activado = $data["activado"];
            $fecha_adqui = $data["fecha_adqui"];

        }

        $insertarSql = "INSERT INTO software(nombre_software,proveedor,tipo_licencia,activado, fecha_adqui)VALUES('$nombre_software','$proveedor','$tipo_licencia','$activado','$fecha_adqui')";
        $resultado = $conectar->prepare($insertarSql);
        $resultado->execute();
        //$conectar->commit();
    }
    }
        Class Actualizar{
        public static function ActualizarSoftware($id){
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $conectar = Conexion::getInstance()->getConexion();
            if ($data !== null) {
                $nombre_software = $data["nombre_software"];
                $proveedor = $data["proveedor"];
                $tipo_licencia = $data["tipo_licencia"];
                $activado = $data["activado"];
                $fecha_adqui = $data["fecha_adqui"];
            }

            $updatesql = "UPDATE software  set nombre_software= '$nombre_software',proveedor= '$proveedor',tipo_licencia='$tipo_licencia',activado='$activado',fecha_adqui='$fecha_adqui'  Where id='$id'";
            $resultado = $conectar->prepare($updatesql);
            $resultado->execute();
            echo json_encode($resultado);
            //$conectar->commit();
        }
    } 
?>
