<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Sesion.php');
Class Obtener{
    public static function ObtenerUsuarios() {
        try {
            $conectar = Conexion::getInstance()->getConexion();
    
            // Obtener los parámetros enviados por DataTables
            $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
            $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
            $search = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
            $orderColumnIndex = isset($_GET['order'][0]['column']) ? intval($_GET['order'][0]['column']) : 0;
            $orderColumnName = isset($_GET['columns'][$orderColumnIndex]['data']) ? $_GET['columns'][$orderColumnIndex]['data'] : 'id';
            $orderDir = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';
    
            // Sanitizar entradas para evitar inyección SQL
            $allowedColumns = ['cedula', 'nombre', 'apellido', 'email', 'rol', 'fecha_ingreso'];
            if (!in_array($orderColumnName, $allowedColumns)) {
                $orderColumnName = 'id';
            }
            $orderDir = $orderDir === 'desc' ? 'DESC' : 'ASC';
    
            // Consulta principal
            $query = "SELECT * FROM usuarios WHERE activo = 'si'";
            if (!empty($search)) {
                $query .= " AND (cedula LIKE :search OR nombre LIKE :search OR apellido LIKE :search OR email LIKE :search OR rol LIKE :search OR fecha_ingreso LIKE :search)";
            }
            $query .= " ORDER BY " . $orderColumnName . " " . $orderDir . " LIMIT :start, :length";
    
            // Preparar y ejecutar consulta
            $resultado = $conectar->prepare($query);
            if (!empty($search)) {
                $searchParam = "%$search%";
                $resultado->bindParam(':search', $searchParam, PDO::PARAM_STR);
            }
            $resultado->bindParam(':start', $start, PDO::PARAM_INT);
            $resultado->bindParam(':length', $length, PDO::PARAM_INT);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
            // Obtener el total de registros sin filtrar para la paginación
            $totalRegistrosQuery = "SELECT COUNT(*) FROM usuarios WHERE activo = 'si'";
            $totalRegistros = $conectar->query($totalRegistrosQuery)->fetchColumn();
    
            // Obtener el total de registros después de aplicar el filtro de búsqueda
            $filtroRegistrosQuery = "SELECT COUNT(*) FROM usuarios WHERE activo = 'si'";
            if (!empty($search)) {
                $filtroRegistrosQuery .= " AND (cedula LIKE :search OR nombre LIKE :search OR apellido LIKE :search OR email LIKE :search OR rol LIKE :search OR fecha_ingreso LIKE :search)";
            }
            $filtroRegistrosStmt = $conectar->prepare($filtroRegistrosQuery);
            if (!empty($search)) {
                $filtroRegistrosStmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
            }
            $filtroRegistrosStmt->execute();
            $filtroRegistros = $filtroRegistrosStmt->fetchColumn();
    
            // Respuesta JSON para DataTables
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
        public static function ActualizarContrasena($data){
            try {
                if ($data !== null) {
                    $conectar = Conexion::getInstance()->getConexion();
                    $updatesql = "UPDATE usuarios SET psswd = :psswd WHERE id = :id";
                    $resultado = $conectar->prepare($updatesql);
                    $resultado->bindParam(':psswd', $data["password"], PDO::PARAM_STR);
                    $resultado->bindParam(':id', $data["id"], PDO::PARAM_INT);
                    $resultado->execute();
                    //$conectar->commit();
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid input']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        public static function ActualizarPerfil($data){
            try {
                if ($data !== null) {
                    $conectar = Conexion::getInstance()->getConexion();
                    $nombre = htmlspecialchars($data["nombre"]);
                    $apellido = htmlspecialchars($data["apellido"]);
                    $cedula = htmlspecialchars($data["cedula"]);
                    $email = htmlspecialchars($data["correo"]);
                    $id = htmlspecialchars($data["id"]);
                    $updatesql = "UPDATE usuarios  SET email= '$email',nombre= '$nombre',apellido= '$apellido',cedula= '$cedula' WHERE id='$id'";
                    $resultado = $conectar->prepare($updatesql);
                    $resultado->execute();
                    Sesion::getInstance()->setSesion("email", $email);
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['cedula'] = $cedula;
                    $_SESSION['correo'] = $email;
                    //$conectar->commit();
                    echo json_encode('Actualizado');
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
