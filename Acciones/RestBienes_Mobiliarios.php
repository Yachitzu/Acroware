<?php
include_once ("crudBienes_Mobiliarios.php");
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $resultado = AccionesBienes_mobiliarios::listarBienes_mobiliarios();
        echo json_encode($resultado);  
        break;
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $codigo_uta = filter_var($data['codigo_uta'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $serie = filter_var($data['serie'], FILTER_SANITIZE_STRING);
        $id_marca = filter_var($data['id_marca'], FILTER_SANITIZE_STRING);
        $modelo = filter_var($data['modelo'], FILTER_SANITIZE_STRING);
        $color = filter_var($data['color'], FILTER_SANITIZE_STRING);
        $material = filter_var($data['material'], FILTER_SANITIZE_STRING);
        $dimensiones = filter_var($data['dimensiones'], FILTER_SANITIZE_STRING);
        $condicion = filter_var($data['condicion'], FILTER_SANITIZE_STRING);
        $custodio = filter_var($data['custodio'], FILTER_SANITIZE_STRING);
        $valor = filter_var($data['valor'], FILTER_SANITIZE_STRING);
        $id_area_per = filter_var($data['id_area_per'], FILTER_SANITIZE_STRING);
        $id_ubi_per = filter_var($data['id_ubi_per'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBienes_mobiliarios::insertarBienes_mobiliarios($codigo_uta, $nombre, $serie, $id_marca, $modelo, $color, $material, $dimensiones, $condicion, $custodio, $valor, $id_area_per, $id_ubi_per);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "El bien mobiliario ha sido insertado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo insertar el bien mobiliario."]);
        }
        break;
    case "PUT":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $codigo_uta = filter_var($data['codigo_uta'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $serie = filter_var($data['serie'], FILTER_SANITIZE_STRING);
        $id_marca = filter_var($data['id_marca'], FILTER_SANITIZE_STRING);
        $modelo = filter_var($data['modelo'], FILTER_SANITIZE_STRING);
        $color = filter_var($data['color'], FILTER_SANITIZE_STRING);
        $material = filter_var($data['material'], FILTER_SANITIZE_STRING);
        $dimensiones = filter_var($data['dimensiones'], FILTER_SANITIZE_STRING);
        $condicion = filter_var($data['condicion'], FILTER_SANITIZE_STRING);
        $custodio = filter_var($data['custodio'], FILTER_SANITIZE_STRING);
        $valor = filter_var($data['valor'], FILTER_SANITIZE_STRING);
        $id_area_per = filter_var($data['id_area_per'], FILTER_SANITIZE_STRING);
        $id_ubi_per = filter_var($data['id_ubi_per'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBienes_mobiliarios::actualizarBienes_mobiliarios($id,$codigo_uta, $nombre, $serie, $id_marca, $modelo, $color, $material, $dimensiones, $condicion, $custodio, $valor, $id_area_per, $id_ubi_per);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "El bien mobiliario ha sido actualizado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo actualizar el bien mobiliario."]);
        }
        break;
    case "DELETE":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBienes_mobiliarios::eliminarBienes_mobiliarios($id);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "El bien mobiliario ha sido eliminado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo eliminar el bien mobiliario."]);
        }
        break;
}
?>