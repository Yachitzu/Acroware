<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php';

class Obtener{
    public static function ObtenerComponente(){
        
    }
    
    public static function ObtenerNombres(){
        $conectar=Conexion::getInstance()->getConexion();
        $select="SELECT id,nombre FROM componentes";
        $resultado=$conectar->prepare($select);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo(json_encode($data));
    }

    public static function ObtenerById($id){
        
    }
}

class Guardar{
    public static function GuardarComponente(){
        
    }
}

class Actualizar{
    public static function ActualizarComponente($id){
        
    }
}

class Eliminar{
    public static function BorrarComponente($id){
        
    }
}
?>