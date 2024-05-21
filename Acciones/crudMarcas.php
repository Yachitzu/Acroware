<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class Obtener
{
    public static function ObtenerMarca()
    {
        $conectar = Conexion::getinstance()->getConexion();
        $select = "SELECT * FROM marcas";
        $resultado = $conectar->prepare($select);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo (json_encode($data));
    }
    public static function ObtenerById($id)
    {
        $bd = Conexion::getInstance()->getConexion();
        $idM = $id;
        $array = array();
        $resultado = $bd->query("SELECT * FROM marcas WHERE id = '$idM'");

        while ($row = $resultado->fetch()) {
            $e = array();
            $e["id"] = $row[0];
            $e["nombre"] = $row[1];
            $e["descripcion"] = $row[2];
            $e["pais"] = $row[3];
            $e["area"] = $row[4];
            array_push($array, $e);
        }
        echo json_encode($array);
    }
}
class Guardar
{
    public static function GuardarMarca()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $conectar = Conexion::getInstance()->getConexion();
        if ($data !== null) {
            $nombre = $data["nombre"];
            $descripcion = $data["descripcion"];
            $pais = $data["pais"];
            $area = $data["area"];

        }

        $insertarSql = "INSERT INTO marcas(nombre,descripcion,pais,area)VALUES('$nombre','$descripcion','$pais','$area')";
        $resultado = $conectar->prepare($insertarSql);
        $resultado->execute();
        //$conectar->commit();
    }
}
class Actualizar
{
    public static function ActualizarMarca($id)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $conectar = Conexion::getInstance()->getConexion();
        if ($data !== null) {
            $nombre = $data["nombre"];
            $descripcion = $data["descripcion"];
            $pais = $data["pais"];
            $area = $data["area"];

        }
        $conectar = Conexion::getInstance()->getConexion();
        $updatesql = "UPDATE marcas  set nombre= '$nombre',descripcion= '$descripcion', 
        pais= '$pais', area='$area' Where id ='$id'";
        $resultado = $conectar->prepare($updatesql);
        $resultado->execute();
        echo json_encode($resultado);
        //$conectar->commit();
    }
}
class Eliminar
{
    public static function BorrarMarca($id)
    {
        $conectar = Conexion::getInstance()->getConexion();
        $borrarSQL = "DELETE FROM marcas WHERE id ='$id'";
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