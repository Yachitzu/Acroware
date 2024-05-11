<?php

    include_once("IStrategy.php");
    include_once("C:/xampp/htdocs/SOA/sistemas/DAS/Acroware/patrones/Singleton/Sesion.php");

    class Authenticator
    {
        private $authStrategy;

        public function setAuthStrategy(AuthenticationStrategy $authStrategy)
        {
            $this->authStrategy = $authStrategy;
        }

        public function authenticateUser($user, $password) {
            if (!is_string($user) || !is_string($password)) {
                throw new InvalidArgumentException("Invalid input");
            }
            $this->authStrategy->authenticate($user, $password);
        }

        public function closeSession() {
            Sesion::getInstance()->cerrarSesion();
            header('Location: ' . htmlspecialchars('pages/login/login.php', ENT_QUOTES, 'UTF-8'));
            exit(); 
        }
        
    }

?>