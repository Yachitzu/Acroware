<?php
include_once ('crudUbicaciones.php');
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $resultado = AccionesUbicaciones::listarUbicaciones();
        echo json_encode($resultado);
        break;
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $id_area_per = filter_var($data['id_area_per'], FILTER_SANITIZE_STRING);
        $resultado = AccionesUbicaciones::insertarUbicaciones($nombre, $descripcion, $id_area_per);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Ubicacion insertada con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo insertar la ubicación."]);
        }
        break;
    case "PUT":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $id_area_per = filter_var($data['id_area_per'], FILTER_SANITIZE_STRING);
        $resultado = AccionesUbicaciones::actualizarUbicacion($id, $nombre, $descripcion, $id_area_per);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Ubicacion actualizada con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo actualizar la ubicación."]);
        }
        break;
    case "DELETE":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $resultado = AccionesUbicaciones::eliminarUbicacion($id);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Ubicación eliminada."]);
        }
        break;
}
?>