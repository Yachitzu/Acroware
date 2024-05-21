<?php
include_once ('CrudMarcas.php');
$opc = $_SERVER["REQUEST_METHOD"];
switch ($opc) {
    case 'GET':
        if (isset($_GET['id'])) {
            Obtener::ObtenerById($_GET['id']);
        } else {
            Obtener::ObtenerMarca();
        }
        break;
    case 'POST':
        Guardar::GuardarMarca();
        break;
    case "DELETE":
        $id = $_GET['id'];
        Eliminar::BorrarMarca($id);
        break;
    case "PUT":
        $id = $_GET["id"];
        Actualizar::ActualizarMarca($id);
        break;
}
?>