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
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

?>
