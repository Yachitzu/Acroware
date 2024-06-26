<?php
/**
 * @file
 * @brief Controlador principal para gestionar las operaciones CRUD de marcas.
 *
 * Este archivo maneja las solicitudes HTTP (GET, POST, DELETE, PUT) y las redirige
 * a las funciones correspondientes en la clase `CrudMarcas`.
 */
include_once ('CrudMarcas.php');

header('Content-Type: application/json');

// Obtener el método de solicitud HTTP
$opc = $_SERVER["REQUEST_METHOD"];

/**
 * @brief Maneja las solicitudes HTTP entrantes y llama a las funciones CRUD correspondientes.
 */
switch ($opc) {
    case 'GET':
          /**
         * @brief Maneja las solicitudes GET.
         *
         * Si se proporciona un ID, obtiene la marca por ID, de lo contrario, obtiene todas las marcas.
         */
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Obtener::ObtenerById($_GET['id']);
        } else {
            Obtener::ObtenerMarca();
        }
        break;
    case 'POST':
         /**
         * @brief Maneja las solicitudes POST.
         *
         * Guarda una nueva marca.
         */
        Guardar::GuardarMarca();
        break;
    case 'DELETE':
         /**
         * @brief Maneja las solicitudes DELETE.
         *
         * Elimina una nueva marca.
         */
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Eliminar::BorrarMarca($_GET['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    case 'PUT':
         /**
         * @brief Maneja las solicitudes PUT.
         *
         * Edita una nueva marca.
         */
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            Actualizar::ActualizarMarca($data['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Método HTTP no soportado']);
        break;
}

