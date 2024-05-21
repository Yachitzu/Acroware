<?php
include_once('CrudUsuarios.php');
$opc=$_SERVER["REQUEST_METHOD"];
switch ($opc) {
        case 'GET':
            if (isset($_GET['cedula'])) {
                Obtener::ObtenerById($_GET['cedula']);
            }else{
                Obtener::ObtenerUsuarios();
            }
            break;
        case 'POST':
            Guardar::GuardarUsuario();
            break;
        case "DELETE":
            $id = $_GET['id'];
            Eliminar::BorrarUsuario($id);
            break;
        case "PUT":
            $id = $_GET["id"];
            Actualizar::ActualizarUsuario($id);
            break;
    }
?>
