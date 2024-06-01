<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once 'funciones_recordatorios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $result = eliminarRecordatorio($id);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Error al eliminar el recordatorio']);
        }
    } else {
        echo json_encode(['error' => 'ID no presente en la solicitud']);
    }
}