<?php
include_once('crudComponentes.php');
header('Content-Type: application/json');
$opc = $_SERVER["REQUEST_METHOD"];
switch ($opc) {
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            
        } else {
            
        }
        break;
    case 'POST':
        
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Método HTTP inválido']);
        break;
}
?>