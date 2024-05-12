<?php
include_once ("crudFacultades.php");
include_once ("crudBloques.php");
include_once ("crudAreas.php");

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
                $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
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
            case 2:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
                $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
                $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
                $campus = filter_var($data['campus'], FILTER_SANITIZE_STRING);
                $resultado = AccionesFacultades::actualizarFacultades($id, $nombre, $descripcion, $campus);

                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Facultad actualizada con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo actualizar la facultad."]);
                }
                break;
            case 3:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
                $resultado = AccionesFacultades::EliminarFacultad($id);
                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Facultad eliminada con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo eliminar la facultad."]);
                }
                break;

            //BLOQUES
            case 4:
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
            case 5:
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
            case 6:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
                $resultado = AccionesBloques::eliminarBloque($id);
                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Bloque eliminado con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo eliminar el bloque."]);
                }
                break;

            //AREAS
            case 7:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
                $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
                $piso = filter_var($data['piso'], FILTER_SANITIZE_STRING);
                $id_bloque_per = filter_var($data['id_bloque_per'], FILTER_SANITIZE_STRING);
                $id_usu_encargado = filter_var($data['id_usu_encargado'], FILTER_SANITIZE_STRING);
                $resultado = AccionesAreas::insertarAreas($nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado);
                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Área insertada con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo insertar la área."]);
                }
                break;
            case 8:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
                $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
                $descripcion = filter_var($data['descripcion'], FILTER_SANITIZE_STRING);
                $piso = filter_var($data['piso'], FILTER_SANITIZE_STRING);
                $id_bloque_per = filter_var($data['id_bloque_per'], FILTER_SANITIZE_STRING);
                $id_usu_encargado = filter_var($data['id_usu_encargado'], FILTER_SANITIZE_STRING);
                $id_facultad_per = filter_var($data['$id_facultad_per'], FILTER_SANITIZE_STRING);
                $resultado = AccionesAreas::actualizarArea($id, $nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado);
                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Área actualizada con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo actualizar el área."]);
                }
                break;

            case 9:
                $json_input = file_get_contents('php://input');
                $data = json_decode($json_input, true);
                $id = isset($data['id']) ? filter_var($data['id'], FILTER_SANITIZE_STRING) : null;
                $resultado = AccionesAreas::eliminarArea($id);
                if ($resultado === 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Área eliminada con éxito."]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "No se pudo eliminar el área."]);
                }
                break;
            default:
                break;
        }
        break;
}
?>