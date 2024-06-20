<?php
include_once ("crudBienes_Informaticos.php");
header('Content-Type: application/json');
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $operation = isset($_GET['op']) ? $_GET['op'] : null;
        switch ($operation) {
            case '4':
                echo AccionesBienes_Informaticos::selectBloques();
                break;
            case '5':
                echo AccionesBienes_Informaticos::selectAreas();
                break;
            default:
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Operación no válida'
                ]);
                break;
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
