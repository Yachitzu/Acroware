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
        $cuerpo = "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Recuperación de Contraseña</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 650px; /* Incrementa el ancho máximo del contenedor */
                    margin: 0 auto;
                    display: flex;
                    align-items: stretch;
                }
                .logo-container {
                    flex: 1;
                    background: url('../../resources/images/logos/Captura.PNG') no-repeat center center;
                    background-size: cover;
                    border-radius: 5px 0 0 5px;
                }
                .content-container {
                    flex: 2;
                    padding-left: 20px;
                }
                .header {
                    background-color: #BD3503;
                    color: white;
                    padding: 10px 0;
                    text-align: center;
                    border-radius: 0 5px 0 0;
                }
                .content {
                    margin: 20px 0;
                }
                .footer {
                    margin-top: 20px;
                    text-align: center;
                    color: #888;
                }
                .button {
                    display: inline-block;
                    padding: 10px 40px;
                    margin: 20px auto;
                    color: white;
                    background-color: #BD3503;
                    text-decoration: none;
                    border-radius: 5px;
                    text-align: center;
                }
                .small-text {
                    color: #BD3503;
                    font-size: 14px;
                }
                .font-weight-semi-bold{
                    font-weight: 550 !important;
                }
                .btn-block {
                    display: block;
                    width: 50%;
                }
                
                .btn-block + .btn-block {
                    margin-top: 0.5rem;
                }
                
                /* Media query para dispositivos con ancho máximo de 600px (como celulares) */
                @media (max-width: 600px) {
                    .container {
                        flex-direction: column; /* Cambia la dirección del flujo a vertical */
                    }
                    .logo-container {
                        display: none; /* Oculta la sección de imágenes */
                    }
                    .content-container {
                        border-radius: 0 0 5px 5px; /* Ajusta los bordes inferiores del contenedor de contenido */
                        padding-left: 0; /* Elimina el relleno a la izquierda */
                    }
                }
            </style>
        </head>
        <body>
            <div class='container'>
                
                <div class='content-container'>
                    <div class='header'>
                        <h1>¡Hola, buen día!</h1>
                    </div>
                    <div class='content'>
                        <p>Hola, se ha realizado una solicitud para restablecer tu contraseña, por favor da clic en el botón para realizar esta acción.</p>
                        <p class='small-text'>Gracias por estar con nosotros.</p>
                        <p style='margin-top: 20px;'>Saludos,<br>El equipo de <span style='color: #BD3503;'>Acroware</span></p>
                        <div style='text-align: center;'>
                            <a href='$url' class='btn-block button font-weight-semi-bold'>Cambiar Contraseña</a>
                        </div>
                    </div>
                    <div class='footer'>
                        <p>Este es un correo generado automáticamente, por favor no responda a este mensaje.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>";

        // Enviar correo electrónico
        $enviar_email = Email::enviarEmail($email, $asunto, $cuerpo);

        // Redirigir a una página de confirmación
        header('Location:login.php');
        exit();
    }
}
?>
