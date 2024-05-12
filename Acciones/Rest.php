<?php
include_once ("crudFacultades.php");
$accion = $_SERVER['REQUEST_METHOD'];
switch ($accion) {
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $opcion = isset($data['opcion']) ? filter_var($data['opcion'], FILTER_VALIDATE_INT) : null;
        switch ($opcion) {
            //FACULTADES
            case 1:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
                $descripcion =filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
                $campus = filter_var($data['campus'], FILTER_SANITIZE_STRING);

                $resultado = AccionesFacultades::insertarFacultades($nombre, $descripcion, $campus);

                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Facultad insertada con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo insertar la facultad."]);
                }
                break;
            default:
                break;
        }
        break;
}
?>