<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

function obtenerRecordatoriosPendientes($usuario_id) {
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $query = "SELECT * FROM recordatorio WHERE usuario_id = :usuario_id AND estado = 'pendiente'";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        return [];
    }
}

function agregarRecordatorio($actividad, $usuario_id) {
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $query = "INSERT INTO recordatorio (actividad, usuario_id, estado) VALUES (:actividad, :usuario_id, 'pendiente')";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':actividad', $actividad, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $conexion->lastInsertId();
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        return false;
    }
}

function actualizarEstadoRecordatorio($id, $estado) {
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $query = "UPDATE recordatorio SET estado = :estado WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        return false;
    }
}

function eliminarRecordatorio($id) {
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $query = "DELETE FROM recordatorio WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        
        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        return false;
    }
}
?>
