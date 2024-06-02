<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
Class Obtener{
    public static function ObtenerUsuarios(){
        try{
            $conectar=Conexion::getInstance()->getConexion();

            // Obtener los parámetros enviados por DataTables
            $start = isset($_GET['start']) ? $_GET['start'] : 0;
            $length = isset($_GET['length']) ? $_GET['length'] : 10;
            $search = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
            $orderColumnIndex = isset($_GET['order'][0]['column']) ? $_GET['order'][0]['column'] : 0;
            $orderColumnName = isset($_GET['columns'][$orderColumnIndex]['data']) ? $_GET['columns'][$orderColumnIndex]['data'] : 'id';
            $orderDir = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';

            $select="SELECT * FROM usuarios WHERE activo = 'si'";
            if (!empty($search)) {
                $query .= " AND (nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR cedula LIKE '%$search%' OR email LIKE '%$search%' OR rol LIKE '%$search%' OR fechaCreacion LIKE '%$search%')";
            }
            $query .= " ORDER BY " . $orderColumnName . " " . $orderDir . " LIMIT " . $start . ", " . $length;

            $resultado = $conectar->prepare($query);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            // Obtener el total de registros sin filtrar para la paginación
            $totalRegistros = $conectar->query("SELECT COUNT(*) FROM usuarios WHERE activo = 'si'")->fetchColumn();

            // Obtener el total de registros después de aplicar el filtro de búsqueda
            $filtroRegistros = $conectar->query("SELECT COUNT(*) FROM usuarios WHERE activo = 'si' AND (nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR cedula LIKE '%$search%' OR email LIKE '%$search%' OR rol LIKE '%$search%' OR fechaCreacion LIKE '%$search%')")->fetchColumn();

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
                $select = "SELECT * FROM usuarios WHERE id = :id";
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
    Class Guardar{
        public static function GuardarUsuario()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data !== null) {
                $conectar = Conexion::getInstance()->getConexion();
                $insertarSql = "INSERT INTO usuarios(nombre, apellido, cedula, email, rol, psswd) VALUES (:nombre, :apellido, :cedula, :email, :rol, :psswd)";
                $resultado = $conectar->prepare($insertarSql);
                $resultado->bindParam(':nombre', $data["nombre"], PDO::PARAM_STR);
                $resultado->bindParam(':apellido', $data["apellido"], PDO::PARAM_STR);
                $resultado->bindParam(':cedula', $data["cedula"], PDO::PARAM_STR);
                $resultado->bindParam(':email', $data["email"], PDO::PARAM_STR);
                $resultado->bindParam(':rol', $data["rol"], PDO::PARAM_STR);
                $resultado->bindParam(':psswd', $data["psswd"], PDO::PARAM_STR);
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
        public static function ActualizarUsuario($id){
            try {
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                if ($data !== null) {
                    $conectar = Conexion::getInstance()->getConexion();
                    $updatesql = "UPDATE usuarios SET email = :email, rol = :rol WHERE id = :id";
                    $resultado = $conectar->prepare($updatesql);
                    $resultado->bindParam(':email', $data["email"], PDO::PARAM_STR);
                    $resultado->bindParam(':rol', $data["rol"], PDO::PARAM_STR);
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
    class Eliminar{
        public static function BorrarUsuario($id)
        {
            try {
                $conectar = Conexion::getInstance()->getConexion();
    
                // Verificación si el usuario está siendo utilizado en aréa
                $verif1 = $conectar->prepare("SELECT COUNT(*) FROM areas WHERE id_usu_encargado = :id");
                $verif1->bindParam(':id', $id, PDO::PARAM_INT);
                $verif1->execute();
                $resultado1 = $verif1->fetchColumn();
    
                if ($resultado1 > 0 ) {
                    echo json_encode(['success' => false, 'message' => 'No se puede eliminar, el usuario está siendo utilizado en otra(s) tablas(s)']);
                } else {
    
                    $borrarSQL = "UPDATE usuarios SET activo = 'no' WHERE id = :id";
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
?>
