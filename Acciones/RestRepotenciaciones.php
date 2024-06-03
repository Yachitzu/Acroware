<?php
include_once('crudRepotenciaciones.php');
header('Content-Type: application/json');
$opc = $_SERVER["REQUEST_METHOD"];
switch ($opc) {
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Obtener::ObtenerById($_GET['id']);
        } else {
            Obtener::ObtenerRepotenciacion();
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        Guardar::GuardarRepotenciacion($data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Eliminar::BorrarRepotenciacion($_GET['id'],$_GET['componente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            Actualizar::ActualizarRepotenciacion($data);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Método HTTP no soportado']);
        break;
}
?>