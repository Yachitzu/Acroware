<?php
include_once __DIR__. '/../patrones/Singleton/Conexion.php';

class Obtener{
    public static function ObtenerComponente(){
        
    }
    
    public static function ObtenerNombres(){
        try {
            $conectar=Conexion::getInstance()->getConexion();
            $select="SELECT id,nombre FROM componentes";
            $resultado=$conectar->prepare($select);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo(json_encode($data));
            return 0;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            return 2;
        }
    }

    public static function ObtenerById($id){
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $select = "SELECT * FROM componentes WHERE id = :id";
            $resultado = $conectar->prepare($select);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            $data = $resultado->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
            return 0;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            return 2;
        }
    }
}

class Guardar{
    public static function GuardarComponente($data){
        try {
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $insertarSql = "INSERT INTO componentes(nombre, descripcion, serie, codigo_adi_uta, id_bien_infor_per, repotenciado) VALUES (:nombre, :descripcion, :serie, :codigo_adi_uta, :id_bien_infor_per, :repotenciado)";
                $resultado = $conectar->prepare($insertarSql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':serie', $data["serie"], PDO::PARAM_STR);
                $resultado->bindParam(':codigo_adi_uta', $data["codigo_adi_uta"], PDO::PARAM_STR);
                $resultado->bindParam(':id_bien_infor_per', $data["id_bien_infor_per"], PDO::PARAM_STR);
                $resultado->bindParam(':repotenciado', $data["repotenciado"], PDO::PARAM_STR);
                $resultado->execute();
                echo json_encode(['success' => true]);
                return 0;
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
                return 1;
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            return 2;
        } 
    }
}

class Actualizar{
    public static function ActualizarComponente($id,$data){
        try {
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $updatesql = "UPDATE componentes SET nombre = :nombre, descripcion = :descripcion, serie = :serie, codigo_adi_uta = :codigo_adi_uta, id_bien_infor_per = :id_bien_infor_per, repotenciado = :repotenciado WHERE id = :id";
                $resultado = $conectar->prepare($updatesql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':serie', $data["serie"], PDO::PARAM_STR);
                $resultado->bindParam(':codigo_adi_uta', $data["codigo_adi_uta"], PDO::PARAM_STR);
                $resultado->bindParam(':id_bien_infor_per', $data["id_bien_infor_per"], PDO::PARAM_STR);
                $resultado->bindParam(':repotenciado', $data["repotenciado"], PDO::PARAM_STR);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado->execute();
                echo json_encode(['success' => true]);
                return 0;
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
                return 1;
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            return 2;
        } 
    }
}

class Eliminar{
   
    public static function BorrarComponente($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();

            // Verificación si el componente está siendo utilizado en repotenciaciones
            $verif1 = $conectar->prepare("SELECT COUNT(*) FROM repotenciaciones WHERE id_componente = :id");
            $verif1->bindParam(':id', $id, PDO::PARAM_INT);
            $verif1->execute();
            $resultado1 = $verif1->fetchColumn();

         

            if ($resultado1 > 0 ) {
                echo json_encode(['success' => false, 'message' => 'No se puede eliminar, el componente está siendo utilizado en otra(s) tablas(s)']);
                return 3;
            } else {

                $borrarSQL = "UPDATE componentes SET activo = 'no' WHERE id = :id";
                $resultado = $conectar->prepare($borrarSQL);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado->execute();
                $rowCount = $resultado->rowCount();
                if ($rowCount > 0) {
                    echo json_encode(['success' => true, 'message' => "Se eliminaron: $rowCount registros"]);
                    return 0;
                } else {
                    echo json_encode(['success' => false, 'message' => 'No records deleted']);
                    return 1;
                }
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            return 2;
        }
    }

}
?>