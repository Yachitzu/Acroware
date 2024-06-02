<?php
include_once ('CrudUsuarios.php');

header('Content-Type: application/json');

$opc = $_SERVER["REQUEST_METHOD"];
switch ($opc) {
<<<<<<< HEAD
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Obtener::ObtenerById($_GET['id']);
        } else {
            Obtener::ObtenerUsuarios();
        }
        break;
    case 'POST':
        Guardar::GuardarUsuario();
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            Eliminar::BorrarUsuario($_GET['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id']) && !empty($data['id'])) {
            Actualizar::ActualizarUsuario($data['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Método HTTP no soportado']);
        break;
}

=======
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
>>>>>>> bfa74a3d6cb79043436180661766382a9a57cd70
