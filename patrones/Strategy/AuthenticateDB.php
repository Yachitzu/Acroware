<?php
    include_once("C:/xampp/htdocs/SOA/sistemas/DAS/Acroware/patrones/Singleton/Conexion.php");
    include_once("IStrategy.php");
    include_once("C:/xampp/htdocs/SOA/sistemas/DAS/Acroware/patrones/Singleton/Sesion.php");

    class AuthenticateDatabase implements AuthenticationStrategy
    {
        private $conexion;

        public function __construct()
        {
            $this->conexion = Conexion::getInstance()->getConexion();
        }

        public function authenticate($user, $password)
        {
            $consulta = "SELECT * FROM usuarios WHERE BINARY email= :email";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bindParam(':email', $user);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                if ($data['password'] == $password) {
                    Sesion::getInstance()->setSesion("email", $data["email"]);

                    $_SESSION['usuario'] = $data['nombre'].' '.$data['apellido'];
                    $_SESSION['rol'] = $data['rol'];
                    $_SESSION['correo'] = $data['email'];
                }else {
                    header("Location: login.php?error=contrasena");
                    exit();
                }
            } else {
                header("Location: login.php?error=email");
                exit();
            }
        }
    }
?>