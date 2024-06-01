<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once 'funciones_recordatorios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['actividad']) && isset($_POST['usuario_id'])) {
        $actividad = $_POST['actividad'];
        $usuario_id = $_POST['usuario_id'];
        $id = agregarRecordatorio($actividad, $usuario_id);
        if ($id !== false) {
            echo json_encode(['id' => $id, 'actividad' => $actividad, 'estado' => 'pendiente']);
        } else {
            echo json_encode(['error' => 'Error al agregar el recordatorio']);
        }
    } else {
        echo json_encode(['error' => 'Actividad o usuario_id no presentes en la solicitud']);
    }
}
?>