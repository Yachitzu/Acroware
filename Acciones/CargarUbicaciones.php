<?php
include_once ("crudBienes_Informaticos.php");
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        header('Content-Type: application/json');
        if (isset($_GET['area_id'])) {
            $area_id = filter_var($_GET['area_id'], FILTER_SANITIZE_STRING);
            $ubicaciones = AccionesBienes_Informaticos::listarUbicacionesInsertar($area_id);
            echo json_encode($ubicaciones);
        }
        break;
    }
?>