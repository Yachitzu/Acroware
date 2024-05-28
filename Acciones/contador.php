<?php
// Incluimos el archivo de conexión
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

function contarLaboratoristas() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de laboratoristas
        $query = "SELECT COUNT(*) as total FROM usuarios WHERE rol = 'laboratorista'";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function contarSoftware() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de software
        $query = "SELECT COUNT(*) as total FROM software";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function contarComponentes() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de componentes
        $query = "SELECT COUNT(*) as total FROM componentes";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function contarBienesInformaticos() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de bienes informáticos
        $query = "SELECT COUNT(*) as total FROM bienes_informaticos";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function obtenerBienesMobiliariosRecientes() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();

        // Consulta para obtener los últimos 7 registros de bienes mobiliarios
        $query = "SELECT codigo_uta, nombre, modelo, marca, id_ubi_per, activo 
                  FROM bienes_mobiliarios 
                  ORDER BY fecha_ingreso DESC 
                  LIMIT 7";
        $stmt = $conexion->prepare($query);
        $stmt->execute();

        // Obtenemos el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return [];
    }
}

?>
