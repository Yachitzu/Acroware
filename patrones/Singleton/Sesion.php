<?php
    class Sesion{
        private static $instance;
        private $sesion;

        private function __construct() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                if (!isset($_SESSION['initiated'])) {
                    session_regenerate_id();
                    $_SESSION['initiated'] = true;
                }
    
                if (isset($_SESSION['last_access']) && (time() - $_SESSION['last_access'] > 1800)) {
                    $this->cerrarSesion();
                    throw new Exception("Sesión expirada");
                }
                $_SESSION['last_access'] = time();
            }
            $this->sesion = &$_SESSION;
        }

        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new Sesion();
            }
            return self::$instance;
        }

        public function setSesion($llave, $valor){
            $this -> sesion[$llave] = $valor;
        }

        public function getSesion($llave){
            return $this -> sesion[$llave] ?? null;
        }

        public function cerrarSesion() {
            session_unset();
            session_destroy();
        }
    }

?>