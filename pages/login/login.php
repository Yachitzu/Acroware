<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

revisionLogueo();

if (isset($_SESSION['email'])) {
    if ($_SESSION['rol'] == 'admin') {
        header('Location: ../../index.php');
        exit;
    } else {
        if ($_SESSION['rol'] == 'laboratorista') {
            header('Location: ../../index_Laboratorista.php');
            exit;
        } else {
            if ($_SESSION['rol'] == 'reportero') {
                header('Location: ../../index_reportero.php');
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inicio Sesión - AcroWare</title>
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
        href="../../resources/images/Australian_STEM_Video_Game_Challenge-removebg-preview5.png" />
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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 font-berthold">¡Bienvenido!</h1>
                                    </div>
                                    <form class="user" id="login" method="POST"
                                        action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                        <div class="form-group wow fadeIn">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                aria-describedby="emailHelp" placeholder="Correo Electrónico"
                                                name="email" required>
                                        </div>
                                        <div class="form-group wow fadeIn">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Contraseña"
                                                pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$"
                                                title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales."
                                                oninput="validatePassword(this)" required>
                                        </div>
                                        <div class="form-group wow fadeIn">

                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block font-weight-semi-bold text-white">
                                            Iniciar Sesión
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-secondary" href="forgot.html">¿Olvidaste tu Contraseña?</a>

                                    </div>
                                    <div class="text-center">

                                        <a class="small text-secondary" href="../../index.php">Dashboard</a>
                                    </div>

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
    <script src="../../resources/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../resources/js/off-canvas.js"></script>
    <script src="../../resources/js/hoverable-collapse.js"></script>
    <script src="../../resources/js/template.js"></script>
    <script src="../../resources/js/settings.js"></script>
    <script src="../../resources/js/todolist.js"></script>
    <script src="../../resources/js/validation.js"></script>
    <!-- endinject -->
</body>

</html>

<?php
function revisionLogueo()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        include_once ("../../patrones/Strategy/AuthenticateDB.php");
        include_once ("../../patrones/Strategy/Authenticator.php");
        include_once ("../../patrones/Strategy/IStrategy.php");

        $authenticator = new Authenticator;
        $authenticateDB = new AuthenticateDatabase;

        $authenticator->setAuthStrategy($authenticateDB);
        $authenticatorUser = $authenticator->authenticateUser($username, $password);

        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>