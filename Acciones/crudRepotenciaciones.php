<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php';

class Obtener{
    public static function ObtenerRepotenciacion(){
        try {
            $conectar = Conexion::getInstance()->getConexion();

            // Obtener los parámetros enviados por DataTables
            $start = isset($_GET['start']) ? $_GET['start'] : 0;
            $length = isset($_GET['length']) ? $_GET['length'] : 10;
            $search = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
            $orderColumnIndex = isset($_GET['order'][0]['column']) ? $_GET['order'][0]['column'] : 0;
            $orderColumnName = isset($_GET['columns'][$orderColumnIndex]['data']) ? $_GET['columns'][$orderColumnIndex]['data'] : 'id';
            $orderDir = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';

            // Construir la consulta SQL con búsqueda y ordenamiento
            $query = "SELECT repotenciaciones.*, componentes.nombre AS componente,componentes.id AS id_componente FROM repotenciaciones LEFT JOIN componentes ON repotenciaciones.id_componente = componentes.id WHERE repotenciaciones.activo = 'si'";

            if (!empty($search)) {
                $query .= " AND (repotenciaciones.nombre LIKE '%$search%' OR repotenciaciones.serie LIKE '%$search%' OR repotenciaciones.codigo_adi_uta LIKE '%$search%' OR repotenciaciones.detalle_repotenciacion LIKE '%$search%' OR repotenciaciones.fecha_repotenciacion LIKE '%$search%' OR componentes.nombre LIKE '%$search%')";
            }
            $query .= " ORDER BY " . $orderColumnName . " " . $orderDir . " LIMIT " . $start . ", " . $length;

            $resultado = $conectar->prepare($query);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            // Obtener el total de registros sin filtrar para la paginación
            $totalRegistros = $conectar->query("SELECT COUNT(*) FROM repotenciaciones WHERE activo = 'si'")->fetchColumn();

            // Obtener el total de registros después de aplicar el filtro de búsqueda
            $filtroRegistros = $conectar->query("SELECT COUNT(*) FROM repotenciaciones LEFT JOIN componentes ON repotenciaciones.id_componente = componentes.id WHERE repotenciaciones.activo = 'si' AND (repotenciaciones.nombre LIKE '%$search%' OR repotenciaciones.serie LIKE '%$search%' OR repotenciaciones.codigo_adi_uta LIKE '%$search%' OR repotenciaciones.detalle_repotenciacion LIKE '%$search%' OR repotenciaciones.fecha_repotenciacion LIKE '%$search%' OR componentes.nombre LIKE '%$search')")->fetchColumn();

            echo json_encode([
                'draw' => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
                'recordsTotal' => $totalRegistros,
                'recordsFiltered' => $filtroRegistros,
                'data' => $data
            ]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public static function ObtenerById($id){
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $select = "SELECT * FROM repotenciaciones WHERE id = :id";
            $resultado = $conectar->prepare($select);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            $data = $resultado->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Guardar{
    public static function GuardarRepotenciacion($data){
        try {
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $insertarSql = "INSERT INTO repotenciaciones(id_componente, nombre, serie, codigo_adi_uta, detalle_repotenciacion) VALUES (:componente, :nombre, :serie, :codigo, :detalle)";
                $resultado = $conectar->prepare($insertarSql);
                $resultado->bindParam(':componente', $data["componente"], PDO::PARAM_STR);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':serie', $data["serie"], PDO::PARAM_STR);
                $resultado->bindParam(':codigo', $data["codigo"], PDO::PARAM_STR);
                $resultado->bindParam(':detalle', $data["detalle"], PDO::PARAM_STR);
                $resultado->execute();
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Actualizar{
    public static function ActualizarRepotenciacion($data){
        try {
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $updatesql = "UPDATE repotenciaciones SET id_componente = :componente, nombre = :nombre, serie = :serie, codigo_adi_uta = :codigo, detalle_repotenciacion = :detalle WHERE id = :id";
                $resultado = $conectar->prepare($updatesql);
                $resultado->bindParam(':componente', $data["componente"], PDO::PARAM_STR);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':serie', $data["serie"], PDO::PARAM_STR);
                $resultado->bindParam(':codigo', $data["codigo"], PDO::PARAM_STR);
                $resultado->bindParam(':detalle', $data["detalle"], PDO::PARAM_STR);
                $resultado->bindParam(':id', $data['id'], PDO::PARAM_INT);
                $resultado->execute();
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

class Eliminar{
    public static function BorrarRepotenciacion($id,$componente){
        try {
            $conectar = Conexion::getInstance()->getConexion();

            $verif2 = $conectar->prepare("UPDATE componentes SET repotenciado = 'no' WHERE id = :componente");
            $verif2->bindParam(':componente', $componente, PDO::PARAM_INT);
            $verif2->execute();
            $resultado2 = $verif2->fetchColumn();

            $borrarSQL = "UPDATE repotenciaciones SET activo = 'no' WHERE id = :id";
            $resultado = $conectar->prepare($borrarSQL);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            $rowCount = $resultado->rowCount();
            if ($rowCount > 0) {
                echo json_encode(['success' => true, 'message' => "Se eliminaron: $rowCount registros"]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No records deleted']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
?>