<?php
    class Conexion{

        private static $instance;
        private $conexion;

        private function __construct(){
            $host = "localhost";
            $user = "root";
            $password = "15diciembre001";
            $database = "das";

            try {
                $dsn = "mysql:host=$host; dbname=$database;charset=utf8mb4"; // Añadir codificación
                $this->conexion = new PDO($dsn, $user, $password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En producción, considera registrar este error en lugar de mostrarlo
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }
        }

        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new Conexion();
            }
            return self::$instance;
        }

        public function getConexion(){
            return $this -> conexion;
        }
    }
?>
