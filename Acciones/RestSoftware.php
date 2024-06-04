<?php
include_once ('crudSoftware.php');

header('Content-Type: application/json');
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $resultado = AccionesSoftware::listarSoftware();
        echo json_encode($resultado);
        break;
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $nombre_software = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $proveedor = filter_var($data['proveedor'], FILTER_SANITIZE_STRING);
        $activado = filter_var($data['activado'], FILTER_SANITIZE_STRING);
        $tipo_licencia = filter_var($data['tipo_licencia'], FILTER_SANITIZE_STRING);
        $fecha_adqui = filter_var($data['fecha_adqui'], FILTER_SANITIZE_STRING);
        $fecha_activacion = filter_var($data['fecha_activacion'], FILTER_SANITIZE_STRING);

        $resultado = AccionesSoftware::insertarSoftware($nombre_software, $proveedor, $activado, $tipo_licencia, $fecha_adqui, $fecha_activacion);

        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "software insertada con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo insertar el software."]);
        }
        break;
    case "PUT":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        // echo "Datos recibidos: <pre>";
        // print_r($data);
        // echo "</pre>";
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $nombre_software = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $proveedor = filter_var($data['proveedor'], FILTER_SANITIZE_STRING);
        $activado = filter_var($data['activado'], FILTER_SANITIZE_STRING);
        $tipo_licencia = filter_var($data['tipo_licencia'], FILTER_SANITIZE_STRING);
        $fecha_adqui = filter_var($data['fecha_adqui'], FILTER_SANITIZE_STRING);
        $fecha_activacion = filter_var($data['fecha_activacion'], FILTER_SANITIZE_STRING);

        $resultado = AccionesSoftware::actualizarSoftware($id, $nombre_software, $proveedor, $activado, $tipo_licencia, $fecha_adqui, $fecha_activacion);

        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "software actualizado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo actualizar el software."]);
        }
        break;
    case "DELETE":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $resultado = AccionesSoftware::eliminarSoftware($id);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "Software eliminado con éxito."]);
        }
        break;
}
?>