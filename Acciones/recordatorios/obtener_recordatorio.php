<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once 'funciones_recordatorios.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    $usuario_id = $_SESSION['usuario_id'];
    $recordatorios = obtenerRecordatoriosPendientes($usuario_id);
    echo json_encode($recordatorios);
}
?>