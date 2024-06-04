<?php
include_once ("crudBienes_Mobiliarios.php");
$op = $_SERVER["REQUEST_METHOD"];
switch ($op) {
    case 'GET':
        $resultado = AccionesBienes_mobiliarios::listarBienes_mobiliarios();
        echo json_encode($resultado);  
        break;
    case 'POST':
        
        break;
    case "PUT":
       
        break;
    case "DELETE":
       
        break;
}
?>