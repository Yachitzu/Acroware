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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center wow fadeIn">
                                        <h1 class="h4 text-gray-900 mb-2 font-berthold">¿Olvidaste tu contraseña?</h1>
                                        <p class="mb-4">Lo entendemos, pasan cosas. Sólo tienes que introducir tu
                                            dirección de correo electrónico a continuación
                                            ¡Y te enviaremos un enlace para restablecer tu contraseña!</p>
                                    </div>
                                    <form class="user" action="restablecer_clave_solicitud.php" method="POST">
                                        <div class="form-group wow fadeIn">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Correo Electrónico" required>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block font-weight-semi-bold text-white">
                                            Restablecer contraseña
                                        </button>
                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="small text-secondary" href="login.php">¿Ya tienes una cuenta? ¡Inicia
                                            sesión!</a>
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
    <!-- endinject -->
</body>

</html>