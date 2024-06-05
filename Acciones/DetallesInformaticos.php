<?php
include_once("crudBienes_Informaticos.php");

// Obtiene el método de la solicitud HTTP (GET, POST, etc.)
$op = $_SERVER["REQUEST_METHOD"];

// Maneja las solicitudes según el método
switch ($op) {
    case 'GET':
        // Verifica si el parámetro 'id' está presente en la solicitud GET
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Llama a la función para obtener los detalles del bien informático
            $resultado = AccionesBienes_Informaticos::obtenerDetalleBienes_Informaticos($id);
            // Devuelve el resultado en formato JSON
            echo json_encode($resultado);
        } else {
            // Si 'id' no está presente, devuelve un error en formato JSON
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'ID no proporcionado'
            ]);
        }
        break;
    default:
        // Si el método HTTP no es GET, devuelve un error en formato JSON
        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Método no soportado'
        ]);
}
?>
