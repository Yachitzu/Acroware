<?php
class Conexion {
    public function Conectar(){
        define("host","localhost");
        define("usuario","root");
        define("contrasena","");
        define("database","acroware");
        define("charset","utf8");
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND>'SET NAMES UTF-8');
        try {
            $conexion =new PDO("mysql:host=".host.";dbname=".database.";charset".charset,
            usuario,
            contrasena,$opc);
            return $conexion;
        } 
        catch (PDOException $e) {
            die("Error en la conexion".$e->getMessage());
        }
    }
}
?>