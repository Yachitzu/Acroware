<?php
include_once ('crudBloques.php');
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $resultado = AccionesBloques::listarBloques();
        echo json_encode($resultado);
        break;
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $id_facultad_per = filter_var($data['id_facultad_per'], FILTER_SANITIZE_STRING);
        $pisos = filter_var($data['pisos'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBloques::insertarBloques($nombre, $descripcion, $id_facultad_per, $pisos);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Bloque insertado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo insertar el bloque."]);
        }
        break;
    case "PUT":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
        $id_facultad_per = filter_var($data['id_facultad_per'], FILTER_SANITIZE_STRING);
        $pisos = filter_var($data['pisos'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBloques::actualizarBloques($id, $nombre, $descripcion, $id_facultad_per, $pisos);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Bloque actualizado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo actualizar el bloque."]);
        }
        break;
    case "DELETE":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBloques::eliminarBloque($id);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Bloque eliminado con éxito."]);
        }
        break;
}
?>