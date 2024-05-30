<?php
include_once ('CrudMarcas.php');

header('Content-Type: application/json');

$opc = $_SERVER["REQUEST_METHOD"];
switch ($opc) {
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Obtener::ObtenerById($_GET['id']);
        } else {
            Obtener::ObtenerMarca();
        }
        break;
    case 'POST':
        Guardar::GuardarMarca();
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            Eliminar::BorrarMarca($data['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    case 'PUT':
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

