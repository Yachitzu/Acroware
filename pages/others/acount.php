<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['email']) || $_SESSION['rol'] != 'admin') {
  header('Location: ../login/login.php');
  exit;
} else {
  $_SESSION['email'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perfil de Usuario</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../resources/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../resources/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../resources/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../resources/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link href="../../resources/vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../resources/vendors/ti-icons/css/themify-icons.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../resources/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../resources/images/logos/Australian_STEM_Video_Game_Challenge-removebg-preview5.png" />

  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="../../index.php"><img src="../../resources/images/logos/Acroware.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.php"><img src="../../resources/images/logos/acroware-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Error generación de etiqueta</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Justo ahora
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../resources/images/faces/perfil1.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item"  href="acount.php">
                <i class="ti-settings text-primary"></i>
                Editar Perfil
              </a>
              <a class="dropdown-item"  href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="ti-power-off text-primary"></i>
                Cerrar Sesión
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.php -->
      
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">Recordatorio</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Agregar actividad">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Agregar</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Reunión de equipo
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Preparar una presentación
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Generar todas las etiquetas de laboratorio 1
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="Completo">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Visualización de etiquetas
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="Completo">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Revisión de proyectos
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.php -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../management/users.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Usuarios</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Lugares</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../places/faculty.php">Facultades</a></li>
                <li class="nav-item"> <a class="nav-link" href="../places/block.php">Bloques</a></li>
                <li class="nav-item"> <a class="nav-link" href="../places/area.php">Áreas</a></li>
                <li class="nav-item"> <a class="nav-link" href="../places/location.php">Ubicaciones</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../management/marca.php">
                <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Marcas</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Inventario</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../assets/assets-i.php">Bienes Informáticos</a></li>
                
                <li class="nav-item"> <a class="nav-link" href="../assets/repowering.php">Repotenciación</a></li>
                <li class="nav-item"> <a class="nav-link" href="../assets/assets-m.php">Bienes Mobiliarios</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../management/software.php">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Software</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="QR.php">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Escaneo QR</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="acount.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Cuenta</span>
            </a>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
            <div class="row user">
                <div class="col-md-12">
                    <div class="profile">
                        <div class="cover-image d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5">
                            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Cuenta</h1>
                            <div class="d-inline-flex mb-lg-5">
                                <p class="m-0 text-white"><a class="text-white" href="../../index.php">Inicio</a></p>
                                <p class="m-0 text-white px-2">/</p>
                                <p class="m-0 text-white">Perfil de Usuario</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile p-0">
                    </div>
                </div>
            </div>

            <!-- Student Profile -->
            <div class="student-profile py-2">
                <div class="container-count">
                    <div class="row">
                        <div class="col-lg-4 py-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent text-center">
                                    <div class="avatar-perfil">
                                        <img src="../../resources/images/faces/perfil1.png" alt="student dp">
                                    </div>
                                    <button class="edit-button btn-circle bg-primary editar" id="editar">
                                      <i class="fas fa-pencil-alt text-secondary"></i>
                                    </button>
                                </div> 
                                
                                <div class="card-body">
                                  <h3 class="text-center"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido']; ?></h3>
                                    <p class="mb-0"><strong class="pr-1">Rol:</strong><?php 
                                    switch ($_SESSION['rol']) {
                                      case 'admin':
                                        echo 'Administrador';
                                        break;
                                      case 'laboratorista':
                                        echo 'Laboratorista';
                                        break;
                                      case 'reportero':
                                        echo 'Generador de Reportes';
                                        break;
                                      default:
                                        echo 'Estudiante';
                                        break;
                                    } ?></p>
                                    <p class="mb-0"><strong class="pr-1">Correo:</strong><?php echo $_SESSION['correo']; ?></p>
                                    <hr>
                                    <center>
                                      <button class="btn-crud btn-primary text-white text-bold" id="cambiarPass" data-toggle="modal" data-target="#modalCrudPass">Cambiar Contraseña <i class="fas fa-pencil-alt text-secondary"></i></button>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Información Personal</h3>
                            </div>
                            <div class="card-body p-4">
                                <table class="table table-bordered table-count">
                                    <tr>
                                        <th width="30%" class="p-3">Nombre</th>
                                        <td width="2%">:</td>
                                        <td id="nameVar"><?php echo $_SESSION['nombre']; ?></td>

                                    </tr>
                                    <tr>
                                        <th width="30%" class="p-3">Apellido</th>
                                        <td width="2%">:</td>
                                        <td  id="lastNameVar"><?php echo $_SESSION['apellido']; ?></td>

                                    </tr>
                                    <tr>
                                        <th width="30%" class="p-3">Cedula</th>
                                        <td width="2%">:</td>
                                        <td><?php echo $_SESSION['cedula']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div style="height: 26px"></div>
                        
                        <!-- <div class="card shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Información Acerca del Sistema</h3>
                            </div>
                            <div class="card-body p-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%" class="p-3">Área Encargada</th>
                                            <td width="2%">:</td>
                                            <td>Ninguna</td>
                                        </tr>
                                        <tr>
                                            <th width="30%" class="p-3">N° B. Informáticos</th>
                                            <td width="2%">:</td>
                                            <td>Ninguno</td>
                                        </tr>
                                        <tr>
                                            <th width="30%" class="p-3">N° B. Mobiliarios</th>
                                            <td width="2%">:</td>
                                            <td>Ninguno</td>
                                        </tr>
                                    </table>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- partial -->

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.php -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Acroware © 2024. Todos los derechos reservados.</span>
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-primary" id="modal-register-label">¿Listo para partir?</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" class="element-white"></i>
                </button>
            </div> 
            <div class="modal-body">
                <div class="card-body">
                    <p class="card-description">Seleccione "Cerrar sesión" a continuación si está list@ para finalizar su sesión actual.</p>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButton">
                <a class="btn-crud btn-primary text-bold" href="../../cerrar.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white" id="modal-register-label">Editar Perfil</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" class="element-white"></i>
                </button>
            </div>
            <form id="editProfileForm" class="forms-sample">
              <div class="modal-body">
                <div class="grid-margin-modal">          
                    <div class="card-body">
                        <p class="card-description">Por favor, complete los siguientes campos:</p>
                        <div class="form-row">
                          <input type="hidden" name="profile" value="full">
                          <input type="hidden"  name="id" value="<?php echo $_SESSION['id']; ?>">
                          <div class="form-group col-md-6">
                              <label for="Name" class="text-bold">Nombre</label>
                              <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $_SESSION['nombre']?>" required>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="LastName" class="text-bold">Apellido</label>
                              <input type="text" class="form-control" placeholder="Apellido" name="apellido" value="<?php echo $_SESSION['apellido']?>" required>
                          </div>
                          <div class="form-group col-md-12">
                              <label for="ID" class="text-bold">Cédula</label>
                              <input type="text" class="form-control" placeholder="Cédula" name="cedula" value="<?php echo $_SESSION['cedula']?>" required>
                          </div>
                          <div class="form-group col-md-12">
                              <label for="Email" class="text-bold">Correo Electrónico</label>
                              <input type="email" class="form-control" placeholder="Correo Electrónico" name="correo" value="<?php echo $_SESSION['correo']?>" required>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButtonProfile">
                    <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Perfil ">
                </div>
            </form>
          </div>
      </div>
  </div>

<div class="modal fade" id="modalCrudPass" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header bg-primary">
              <h3 class="modal-title text-white" id="modal-register-label">Cambiar Contraseña</h3>
              <p class="modal">Ingrese los datos del Usuario:</p>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times" class="element-white"></i>
              </button>
          </div> 
          <form id="editPasswordForm" class="forms-sample">
          <div class="modal-body">
              <div class="grid-margin-modal">          
                  <div class="card-body">
                      <p class="card-description">Por favor, complete los siguientes campos si desea modificar la contraseña:</p>
                      <div class="form-row">
                          <input type="hidden" name="profile" value="pass">
                          <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                          <div class="form-group col-md-12">
                              <label for="InputPassword" class="text-bold">Contraseña</label>
                              <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Contraseña" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales." oninput="validatePassword(this)" required>
                          </div>
                          <div class="form-group col-md-12">
                              <label for="ConfirmPassword" class="text-bold">Confirmar Contraseña</label>
                              <input type="password" class="form-control" id="ConfirmPassword" name="confirmPassword" placeholder="Contraseña" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales." oninput="validatePassword(this); checkPasswordMatch();" required>
                              <div class="invalid-feedback" id="passwordMatchError" style="display: none;">Las contraseñas no coinciden.</div>
                          </div>  
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButtonPass">
              <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Contraseña ">
          </div>
        </form>
      </div>
  </div>
</div>
<script>
  document.getElementById('editProfileForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });

    fetch('../../Acciones/RestUsers.php', {

      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
      console.log('Success:', data);
      $('#modalCrud').modal('hide');
      location.reload();
    })
    .catch((error) => {
      console.log(data);
      console.error('Error:', error);
    });
  });
  document.getElementById('editPasswordForm').addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });

    fetch('../../Acciones/RestUsers.php', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      $('#modalCrudPass').modal('hide');
    })
    .catch((error) => {
      console.error('Error:', error);
    });
  });
</script>

  <!-- plugins:js -->
  <script src="../../resources/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../resources/vendors/chart.js/Chart.min.js"></script>
  <script src="../../resources/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../../resources/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../resources/js/off-canvas.js"></script>
  <script src="../../resources/js/modal.js"></script>
  <script src="../../resources/js/validation.js"></script>
  <script src="../../resources/js/hoverable-collapse.js"></script>
  <script src="../../resources/js/template.js"></script>
  <script src="../../resources/js/settings.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../resources/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

    <!-- Page level plugins -->
    <script src="../../resources/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="../../resources/vendors/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../resources/js/datatables-demo.js"></script>
</body>

</html>

