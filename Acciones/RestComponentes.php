<?php
include_once('crudComponentes.php');
header('Content-Type: application/json');
$opc = $_SERVER["REQUEST_METHOD"];

/**
 * Procesa las solicitudes HTTP entrantes y dirige las operaciones CRUD correspondientes.
 */
switch ($opc) {
    case 'GET':
        /**
         * Maneja las solicitudes GET.
         *
         * Si se proporciona un 'id', obtiene el componente con ese ID.
         * Si se proporciona 'nombres', obtiene los nombres de los componentes.
         */
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Obtener::ObtenerById($_GET['id']);
        } else {
            if (isset($_GET['nombres'])) {
                Obtener::ObtenerNombres();
            }
        }
        break;
    case 'POST':
        /**
         * Maneja las solicitudes POST.
         *
         * Guarda un nuevo componente.
         */
        Guardar::GuardarComponente();
        break;
    case 'DELETE':
        /**
         * Maneja las solicitudes DELETE.
         *
         * Si se proporciona un 'id', elimina el componente con ese ID.
         */
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Eliminar::BorrarComponente($_GET['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    case 'PUT':
        /**
         * Maneja las solicitudes PUT.
         *
         * Si se proporciona un 'id', actualiza el componente con ese ID.
         */
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            Actualizar::ActualizarComponente($data['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    default:
        /**
         * Maneja solicitudes HTTP no soportadas.
         *
         * Devuelve un mensaje indicando que el método HTTP no está soportado.
         */
        echo json_encode(['success' => false, 'message' => 'Método HTTP no soportado']);
        break;
}
