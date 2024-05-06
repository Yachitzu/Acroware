<?php
header("Access-Control-Allow-Origin:http://localhost:19006");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Headers: *");

include_once('crud.php');
$opc=$_SERVER["REQUEST_METHOD"];
switch ($opc) {
    case 'GET':
        if (isset($_GET['cedula'])) {
            Obtener::ObtenerById($_GET['cedula']);
        }else{
            Obtener::ObtenerUsuario();
        }
        break;
    
    case 'POST':
        Guardar::GuardarUsuario();
        break;
    case "DELETE":
        $cedula=$_GET['cedula'];
        Eliminar::BorrarEstudiantes($cedula);
        break;
    case "PUT":
        $cedula = $_GET["cedula"];
        $nombre = $_GET["nombre"];
        $apellido = $_GET["apellido"];
        $password = $_GET["password"];
        Actualizar::ActualizarUsuario($cedula,$nombre,$apellido,$password);
        break;

}
?>