<?php
include_once ("crudBienes_Informaticos.php");
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        header('Content-Type: application/json');
        if (isset($_GET['id'])) {
            // Si se proporciona un ID en la URL, llamar a una función para manejar esa acción
            $id = $_GET['id'];
            $resultado = AccionesBienes_Informaticos::listarQR($id);
        } else {
            // Si no se proporciona un ID, realizar la acción predeterminada (listar todos los bienes informáticos)
            $resultado = AccionesBienes_Informaticos::listarBienes_Informaticos();
        }
        echo $resultado;
        break;
    case 'POST':
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $codigo_uta = filter_var($data['codigo_uta'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $serie = filter_var($data['serie'], FILTER_SANITIZE_STRING);
        $id_marca = filter_var($data['id_marca'], FILTER_SANITIZE_STRING);
        $modelo = filter_var($data['modelo'], FILTER_SANITIZE_STRING);
        $id_area_per = filter_var($data['id_area_per'], FILTER_SANITIZE_STRING);
        $id_ubi_per = filter_var($data['id_ubi_per'], FILTER_SANITIZE_STRING);
        $ip = filter_var($data['ip'], FILTER_SANITIZE_STRING);
        $custodio = filter_var($data['custodio'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBienes_Informaticos::insertarBienes_Informaticos($codigo_uta, $nombre, $serie, $id_marca, $modelo, $id_area_per, $id_ubi_per, $ip,$custodio);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "El bien informatico ha sido insertado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo insertar el bien informatico."]);
        }
        break;
    case "PUT":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $codigo_uta = filter_var($data['codigo_uta'], FILTER_SANITIZE_STRING);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $serie = filter_var($data['serie'], FILTER_SANITIZE_STRING);
        $id_marca = filter_var($data['id_marca'], FILTER_SANITIZE_STRING);
        $modelo = filter_var($data['modelo'], FILTER_SANITIZE_STRING);
        $id_area_per = filter_var($data['id_area_per'], FILTER_SANITIZE_STRING);
        $id_ubi_per = filter_var($data['id_ubi_per'], FILTER_SANITIZE_STRING);
        $ip = filter_var($data['ip'], FILTER_SANITIZE_STRING);
        $custodio = filter_var($data['custodio'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBienes_Informaticos::actualizarBienes_Informaticos($id, $codigo_uta, $nombre, $serie, $id_marca, $modelo, $id_area_per, $id_ubi_per, $ip, $custodio);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "El bien informatico ha sido actualizado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo actualizar el bien informatico."]);
        }
        break;
    case "DELETE":
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $resultado = AccionesBienes_Informaticos::eliminarBienes_Informaticos($id);
        if ($resultado === 0) {
            http_response_code(200);
            echo json_encode(["message" => "El bien informatico ha sido eliminado con éxito."]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "No se pudo eliminar el bien informatico."]);
        }
        break;
}
?>