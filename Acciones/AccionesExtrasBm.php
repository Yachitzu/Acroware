<?php
include_once ("crudBienes_Mobiliarios.php");
header('Content-Type: application/json');
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $operation = isset($_GET['op']) ? $_GET['op'] : null;
        switch ($operation) {
            case 2:
                if (isset($_GET['usuario_id'])) {
                    $usuario_id = filter_var($_GET['usuario_id'], FILTER_SANITIZE_STRING);
                    $usuarioDestino = AccionesBienes_mobiliarios::listarUsuariosDestino($usuario_id);
                    echo json_encode($usuarioDestino);
                }
                break;
            case 3:
                if (isset($_GET['custodio_id'])) {
                    $custodio_id = filter_var($_GET['custodio_id'], FILTER_SANITIZE_NUMBER_INT);
                    $bienes = AccionesBienes_mobiliarios::listarBienesPorCustodio($custodio_id);
                    echo json_encode($bienes);
                }
                break;
            default:
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Operación no válida'
                ]);
                break;
        }
        break;
    case 'PUT':
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['bienes']) && isset($data['custodioDestino'])) {
            $bienes = $data['bienes'];
            $custodioDestino = $data['custodioDestino'];
            $resultado = AccionesBienes_mobiliarios::actualizarCustodioBienes($bienes, $custodioDestino);
            echo json_encode($resultado);
        }
        break;
    default:
        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Método no soportado'
        ]);
        break;
}
?>