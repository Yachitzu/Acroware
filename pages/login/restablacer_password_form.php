<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

if (empty($_GET['token'])) {
    header('Location: login.php');
    exit();
}
$conexion = Conexion::getInstance()->getConexion();
$consulta = $conexion->prepare('SELECT token FROM recuperar_password WHERE token = :token');
$consulta->bindParam(':token', $_GET['token']);
$consulta->execute();
if ($consulta->rowCount() === 0) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recuperar Contraseña - AcroWare</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../resources/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../resources/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../resources/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../resources/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon"
        href="../../resources/images/logos/Australian_STEM_Video_Game_Challenge-removebg-preview5.png" />
</head>


<body class="bg-login">

    <div class="container-fluid container-login">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center wow fadeIn">
                                        <h1 class="h4 text-gray-900 mb-2 font-berthold">Ingrese su nueva contraseña</h1>
                                    </div>
                                    <form class="user" action="restablacer_password.php" method="POST">
                                        <input type="hidden" name="token"
                                            value="<?php echo htmlspecialchars($_GET['token']); ?>" required>
                                        <div class="form-group wow fadeIn">
                                            <input type="password" name="passwordC"
                                                class="form-control form-control-user" id="passwordC"
                                                placeholder="Nueva contraseña"
                                                pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$"
                                                title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales."
                                                oninput="validatePassword(this)" required>
                                        </div>

                                        <div class="form-group wow fadeIn">
                                            <input type="password" name="ConfirmPassword"
                                                class="form-control form-control-user" id="conPasswordC"
                                                placeholder="Repetir contraseña"
                                                pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$"
                                                title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales."
                                                oninput="validatePassword(this); checkPasswordMatch();" required>
                                            <div class="invalid-feedback" id="passwordMatchError"
                                                style="display: none;">Las contraseñas no coinciden.</div>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block font-weight-semi-bold text-white">
                                            Restablecer contraseña
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../resources/js/validation.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>