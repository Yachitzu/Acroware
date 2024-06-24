<?php
include_once ('crudAreas.php');
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $resultado = AccionesAreas::listarAreas();
        echo json_encode($resultado);
        break;
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $piso = filter_var($data['piso'], FILTER_SANITIZE_STRING);
        $id_bloque_per = filter_var($data['id_bloque_per'], FILTER_SANITIZE_STRING);
        $resultado = AccionesAreas::insertarAreas($nombre, $descripcion, $piso, $id_bloque_per);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Área insertada con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo insertar la área."]);
        }
        break;
    case "PUT":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $piso = filter_var($data['piso'], FILTER_SANITIZE_STRING);
        $id_bloque_per = filter_var($data['id_bloque_per'], FILTER_SANITIZE_STRING);
        $resultado = AccionesAreas::actualizarArea($id, $nombre, $descripcion, $piso, $id_bloque_per);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Área actualizada con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo actualizar el área."]);
        }
        break;
    case "DELETE":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = isset($data['id']) ? filter_var($data['id'], FILTER_SANITIZE_STRING) : null;
        $resultado = AccionesAreas::eliminarArea($id);
        switch ($resultado) {
            case 0:
                http_response_code(200);
                echo json_encode(["message" => "Área eliminada con éxito."]);
                break;
            case 1:
                http_response_code(400);
                echo json_encode(["message" => "No se puede eliminar, la área está referenciada en ubicaciones."]);
                break;
            case 2:
            default:
                http_response_code(500);
                echo json_encode(["message" => "Error al eliminar el área."]);
                break;
        }
        break;
}
?>