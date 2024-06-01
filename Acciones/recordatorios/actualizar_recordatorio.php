<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once 'funciones_recordatorios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['estado'])) {
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $result = actualizarEstadoRecordatorio($id, $estado);
        echo json_encode(['success' => $result]);
    } else {
        echo json_encode(['error' => 'ID o estado no presentes en la solicitud']);
    }
}
?>
