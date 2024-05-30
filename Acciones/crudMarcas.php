<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php';

class Obtener
{
    public static function ObtenerMarca()
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $select = "SELECT * FROM marcas WHERE activo ='si'";
            $resultado = $conectar->prepare($select);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public static function ObtenerById($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $select = "SELECT * FROM marcas WHERE id = :id";
            $resultado = $conectar->prepare($select);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            $data = $resultado->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Guardar
{
    public static function GuardarMarca()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $insertarSql = "INSERT INTO marcas(nombre, descripcion, pais, area) VALUES (:nombre, :descripcion, :pais, :area)";
                $resultado = $conectar->prepare($insertarSql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':pais', $data["pais"], PDO::PARAM_STR);
                $resultado->bindParam(':area', $data["area"], PDO::PARAM_STR);
                $resultado->execute();
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Actualizar
{
    public static function ActualizarMarca($id)
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $updatesql = "UPDATE marcas SET nombre = :nombre, descripcion = :descripcion, pais = :pais, area = :area WHERE id = :id";
                $resultado = $conectar->prepare($updatesql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':pais', $data["pais"], PDO::PARAM_STR);
                $resultado->bindParam(':area', $data["area"], PDO::PARAM_STR);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado->execute();
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Eliminar
{
    public static function BorrarMarca($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $borrarSQL = "UPDATE marcas SET activo = 'no' WHERE id = :id";
            $resultado = $conectar->prepare($borrarSQL);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            $rowCount = $resultado->rowCount();
            if ($rowCount > 0) {
                echo json_encode(['success' => true, 'message' => "Se eliminaron: $rowCount registros"]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No records deleted']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}