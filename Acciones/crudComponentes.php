<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php';

class Obtener
{
    public static function ObtenerComponente()
    {
    }

    public static function ObtenerNombres()
    {
        $conectar = Conexion::getInstance()->getConexion();
        $select = "SELECT id,nombre FROM componentes";
        $resultado = $conectar->prepare($select);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo (json_encode($data));
    }

    public static function ObtenerById($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $select = "SELECT * FROM componentes WHERE id = :id";
            $resultado = $conectar->prepare($select);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            $data = $resultado->fetch(PDO::FETCH_ASSOC);


            $selectRepotenciaciones = "SELECT motivo_repotenciacion, codigo_adi_uta FROM repotenciaciones WHERE id_componente = :id";
            $resultadoRepotenciaciones = $conectar->prepare($selectRepotenciaciones);
            $resultadoRepotenciaciones->bindParam(':id', $id, PDO::PARAM_INT);
            $resultadoRepotenciaciones->execute();
            $dataRepotenciaciones = $resultadoRepotenciaciones->fetch(PDO::FETCH_ASSOC);

            if ($dataRepotenciaciones) {
                $data['motivo_repotenciacion'] = $dataRepotenciaciones['motivo_repotenciacion'];
                $data['codigo_adi_uta'] = $dataRepotenciaciones['codigo_adi_uta'];
            }

            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Guardar
{
    public static function GuardarComponente()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();

                // Insertar en la tabla componentes
                $insertarSql = "INSERT INTO componentes(nombre, descripcion, serie, especificaciones, id_bien_infor_per, repotenciado) VALUES (:nombre, :descripcion, :serie, :especificaciones, :id_bien_infor_per, :repotenciado)";
                $resultado = $conectar->prepare($insertarSql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':serie', $data["serie"], PDO::PARAM_STR);
                $resultado->bindParam(':especificaciones', $data["especificaciones"], PDO::PARAM_STR);
                $resultado->bindParam(':id_bien_infor_per', $data["id_bien_infor_per"], PDO::PARAM_STR);
                $resultado->bindParam(':repotenciado', $data["repotenciado"], PDO::PARAM_STR);

                $resultado->execute();

                // Obtener el id del componente recién insertado
                $idComponente = $conectar->lastInsertId();

                // Verificar si los campos codigo_adi y descripcion_repo están presentes y no están vacíos
                if (!empty($data["codigo_adi_uta"]) && !empty($data["motivo_repotenciacion"])) {
                    // Insertar en la tabla repotenciaciones
                    $insertarRepotenciacionesSql = "INSERT INTO repotenciaciones(id_componente, codigo_adi_uta, motivo_repotenciacion, fecha_repotenciacion) VALUES (:id_componente, :codigo_adi_uta, :motivo_repotenciacion, NOW())";
                    $resultadoRepotenciaciones = $conectar->prepare($insertarRepotenciacionesSql);
                    $resultadoRepotenciaciones->bindParam(':id_componente', $idComponente, PDO::PARAM_INT);
                    $resultadoRepotenciaciones->bindParam(':codigo_adi_uta', $data["codigo_adi_uta"], PDO::PARAM_STR);
                    $resultadoRepotenciaciones->bindParam(':motivo_repotenciacion', $data["motivo_repotenciacion"], PDO::PARAM_STR);

                    $resultadoRepotenciaciones->execute();
                }

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Actualizar
{
    public static function ActualizarComponente($id){
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
    
                // Actualizar los datos del componente
                $updatesql = "UPDATE componentes SET nombre = :nombre, descripcion = :descripcion, serie = :serie, especificaciones = :especificaciones, repotenciado = :repotenciado WHERE id = :id";
                $resultado = $conectar->prepare($updatesql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':serie', $data["serie"], PDO::PARAM_STR);
                $resultado->bindParam(':especificaciones', $data["especificaciones"], PDO::PARAM_STR);
                //$resultado->bindParam(':id_bien_infor_per', $data["id_bien_infor_per"], PDO::PARAM_STR);
                $resultado->bindParam(':repotenciado', $data["repotenciado"], PDO::PARAM_STR);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado->execute();
    
                // Actualizar repotenciaciones si los campos están presentes
                if (!empty($data["codigo_adi_uta"]) && !empty($data["motivo_repotenciacion"])) {
                    $updateRepot = "UPDATE repotenciaciones SET codigo_adi_uta = :codigo_adi_uta, fecha_repotenciacion = NOW(), motivo_repotenciacion = :motivo_repotenciacion WHERE id_componente = :id_componente";
                    $resultadoRepot = $conectar->prepare($updateRepot);
                    $resultadoRepot->bindParam(':codigo_adi_uta', $data["codigo_adi_uta"], PDO::PARAM_STR);
                    $resultadoRepot->bindParam(':motivo_repotenciacion', $data["motivo_repotenciacion"], PDO::PARAM_STR);
                    $resultadoRepot->bindParam(':id_componente', $id, PDO::PARAM_INT);
                    $resultadoRepot->execute();
                }
    
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } 
    }
    
}

class Eliminar
{

    public static function BorrarComponente($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();

            // Verificación si el componente está siendo utilizado en repotenciaciones
            $verif1 = $conectar->prepare("SELECT COUNT(*) FROM repotenciaciones WHERE id_componente = :id");
            $verif1->bindParam(':id', $id, PDO::PARAM_INT);
            $verif1->execute();
            $resultado1 = $verif1->fetchColumn();



            if ($resultado1 > 0) {
                echo json_encode(['success' => false, 'message' => 'No se puede eliminar, el componente está siendo utilizado en otra(s) tablas(s)']);
            } else {

                $borrarSQL = "UPDATE componentes SET activo = 'no' WHERE id = :id";
                $resultado = $conectar->prepare($borrarSQL);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado->execute();
                $rowCount = $resultado->rowCount();
                if ($rowCount > 0) {
                    echo json_encode(['success' => true, 'message' => "Se eliminaron: $rowCount registros"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'El componente seleccionado ya fue dado de baja']);
                }
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
