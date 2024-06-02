<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php';

class Obtener
{
    public static function ObtenerMarca()
    {
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
            $query = "SELECT * FROM marcas WHERE activo = 'si'";
            if (!empty($search)) {
                $query .= " AND (nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR pais LIKE '%$search%' OR area LIKE '%$search%')";
            }
            $query .= " ORDER BY " . $orderColumnName . " " . $orderDir . " LIMIT " . $start . ", " . $length;

            $resultado = $conectar->prepare($query);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

            // Obtener el total de registros sin filtrar para la paginación
            $totalRegistros = $conectar->query("SELECT COUNT(*) FROM marcas WHERE activo = 'si'")->fetchColumn();

            // Obtener el total de registros después de aplicar el filtro de búsqueda
            $filtroRegistros = $conectar->query("SELECT COUNT(*) FROM marcas WHERE activo = 'si' AND (nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR pais LIKE '%$search%' OR area LIKE '%$search%')")->fetchColumn();

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

    public static function ObtenerById($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();
            $select = "SELECT * FROM marcas WHERE id = :id";
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

class Guardar
{
    public static function GuardarMarca()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $insertarSql = "INSERT INTO marcas(nombre, descripcion, pais, area) VALUES (:nombre, :descripcion, :pais, :area)";
                $resultado = $conectar->prepare($insertarSql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':pais', $data["pais"], PDO::PARAM_STR);
                $resultado->bindParam(':area', $data["area"], PDO::PARAM_STR);
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

class Actualizar
{
    public static function ActualizarMarca($id)
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $updatesql = "UPDATE marcas SET nombre = :nombre, descripcion = :descripcion, pais = :pais, area = :area WHERE id = :id";
                $resultado = $conectar->prepare($updatesql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':descripcion', $data["descripcion"], PDO::PARAM_STR);
                $resultado->bindParam(':pais', $data["pais"], PDO::PARAM_STR);
                $resultado->bindParam(':area', $data["area"], PDO::PARAM_STR);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
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

class Eliminar
{
    public static function BorrarMarca($id)
    {
        try {
            $conectar = Conexion::getInstance()->getConexion();

            // Verificación si la marca está siendo utilizada en bienes informáticos
            $verif1 = $conectar->prepare("SELECT COUNT(*) FROM bienes_informaticos WHERE id_marca = :id");
            $verif1->bindParam(':id', $id, PDO::PARAM_INT);
            $verif1->execute();
            $resultado1 = $verif1->fetchColumn();

            //Verificación si la marca está siendo utilizada en bienes muebles
            $verif2 = $conectar->prepare("SELECT COUNT(*) FROM bienes_mobiliarios WHERE id_marca = :id");
            $verif2->bindParam(':id', $id, PDO::PARAM_INT);
            $verif2->execute();
            $resultado2 = $verif2->fetchColumn();

            if ($resultado1 > 0 || $resultado2 > 0) {
                echo json_encode(['success' => false, 'message' => 'No se puede eliminar, la marca está siendo utilizzada en otra(s) tablas(s)']);
            } else {

                $borrarSQL = "UPDATE marcas SET activo = 'no' WHERE id = :id";
                $resultado = $conectar->prepare($borrarSQL);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
                $resultado->execute();
                $rowCount = $resultado->rowCount();
                if ($rowCount > 0) {
                    echo json_encode(['success' => true, 'message' => "Se eliminaron: $rowCount registros"]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No records deleted']);
                }
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
