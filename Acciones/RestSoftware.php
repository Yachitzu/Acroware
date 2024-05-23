<?php
include_once('crudSoftware.php');
$opc=$_SERVER["REQUEST_METHOD"];
switch ($opc) {
        case 'GET':
            if (isset($_GET['id'])) {
                Obtener::ObtenerById($_GET['id']);
            }else{
                Obtener::ObtenerSoftware();
            }
        }
        break;
        case 'POST':
            Guardar::GuardarSoftware();
            break;
        case "DELETE":
            $id = $_GET['id'];
            Eliminar::BorrarSoftware($id);
            break;
?>
