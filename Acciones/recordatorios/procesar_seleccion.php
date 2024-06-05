<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

// Obtener opciones de facultades
function obtenerFacultades() {
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $query = "SELECT id, nombre FROM facultades WHERE activo = 'si'";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        return [];
    }
}

// Obtener opciones de bloques por facultad
function obtenerBloquesPorFacultad($facultad_id) {
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $query = "SELECT id, nombre FROM bloques WHERE id_facultad_per = :facultad_id AND activo = 'si'";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':facultad_id', $facultad_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        return [];
    }
}

// Verificar si se especifica una acción
if(isset($_GET['accion'])) {
    // Si la acción es obtenerBloques
    if($_GET['accion'] == 'obtenerBloques') {
        // Obtener el ID de la facultad desde la solicitud
        if(isset($_GET['facultad'])) {
            $facultad_id = $_GET['facultad'];
            // Llamar a la función para obtener los bloques por facultad
            $bloques = obtenerBloquesPorFacultad($facultad_id);
            // Devolver los bloques como JSON
            echo json_encode($bloques);
        } else {
            // Si no se especifica una facultad, devolver un mensaje de error
            echo json_encode(array('error' => 'No se especificó una facultad'));
        }
    } else {
        // Si se especifica una acción no válida, devolver un mensaje de error
        echo json_encode(array('error' => 'Acción no válida'));
    }
} 
?>
