<?php
include_once('CrudUsuarios.php');
$opc=$_SERVER["REQUEST_METHOD"];
switch ($opc) {
        case 'GET':
            if (isset($_GET['id'])) {
                Obtener::ObtenerById($_GET['id']);
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
            if(isset($_GET['profile'])){
                if($_GET['profile']==='full'){
                    Actualizar::ActualizarPerfil($id);
                }else{
                    Actualizar::ActualizarContrasena($id);
                }
            }else{
                Actualizar::ActualizarUsuario($id);
            }
            break;
    }
?>
