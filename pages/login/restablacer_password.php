<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['passwordC'];
    $confirm_password = $_POST['conPasswordC'];
    if ($new_password !== $confirm_password) {
        header('Location: forgot.php');
    }

    $conexion = Conexion::getInstance()->getConexion();

    // Verificar el token y la fecha de expiración
    $consulta = $conexion->prepare('SELECT email FROM recuperar_password WHERE token = :token AND expFech > NOW()');
    $consulta->bindParam(':token', $token);
    $consulta->execute();
    $result = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $email = $result['email'];

        // Actualizar la contraseña del usuario
        $consulta1 = $conexion->prepare('UPDATE usuarios SET psswd = :psswd WHERE email = :email');
        $consulta1->bindParam(':psswd', $new_password);
        $consulta1->bindParam(':email', $email);
        $consulta1->execute();

        // Eliminar el token de restablecimiento
        $consulta2 = $conexion->prepare('DELETE FROM recuperar_password WHERE email = :email');
        $consulta2->bindParam(':email', $email);
        $consulta2->execute();

        header('Location: exito.php');
        exit();
    } else {
        header('Location: invalido.php');
        exit();
    }
}
?>
