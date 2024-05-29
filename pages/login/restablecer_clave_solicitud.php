<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/Acciones/enviarEmail.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $conexion = Conexion::getInstance()->getConexion();

    // Verificar si el correo electrónico existe en la base de datos
    $consulta = $conexion->prepare('SELECT id FROM usuarios WHERE email = :email');
    $consulta->bindParam(':email', $email);
    $consulta->execute();

    if ($consulta->rowCount() > 0) { 
        // Generar un token de restablecimiento único
        $token = bin2hex(random_bytes(50));
        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);

        // Insertar el token en la base de datos
        $consulta1 = $conexion->prepare('INSERT INTO recuperar_password (email, token, expFech) VALUES (:email, :token, :expFech)');
        $consulta1->bindParam(':email', $email);
        $consulta1->bindParam(':token', $token);
        $consulta1->bindParam(':expFech', $expDate);
        $consulta1->execute();
        
        // Enviar el correo electrónico
        $url='http://localhost/Acroware/pages/login/restablacer_password_form.php?token=' . $token; 
        $asunto="Recuperar clave - Acroware";
        $cuerpo = "Hola, se ha realizado una solicitud para restablecer tu contraseña, por favor ingrese al siguiente enlace para realizar esta acción:<a href='$url'>Cambiar contraseña</a>";
        $enviar_email=Email::enviarEmail($email,$asunto,$cuerpo);
    }

    // Redirigir a una página de confirmación
    header('Location: login.php');
    exit();
}
?>

