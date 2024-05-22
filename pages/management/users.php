<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gestión - Usuarios</title>
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
              <a class="dropdown-item"  href="../others/acount.php">
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
      <nav class="sidebar sidebar-offcanvas " id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="users.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Usuarios</span>
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
                <li class="nav-item"> <a class="nav-link" href="../assets/assets-m.php">Bienes Mobiliarios</a></li>
              </ul>
            </div>
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
            <a class="nav-link" href="marca.php">
                <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Marcas</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../others/acount.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Cuenta</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="software.php">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Software</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../others/QR.php">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Escaneo QR</span>
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
                        <div class="cover-image-gest d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5">
                            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Usuarios</h1>
                            <div class="d-inline-flex mb-lg-5">
                                <p class="m-0 text-white"><a class="text-white" href="../../index.php">Inicio</a></p>
                                <p class="m-0 text-white px-2">/</p>
                                <p class="m-0 text-white">Gestor de Usuarios</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tile p-0">
                    </div>
                </div>
            </div>

          
            <div class="container-fluid py-4">
            
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <button class="btn-crud btn-secondary btn-icon-split" id="agregar">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus-circle"></i> 
                            </span>
                            <span class="text text-white">Agregar Usuario</span>
                        </button>
                    </div>
                    <div class="card-body bg-darkwhite">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cedula</th>
                                        <th>Email</th>
                                        <th>Contraseña</th>
                                        <th>Rol</th>
                                        <th>Fecha Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTableBody">
                                   
                                    
                                </tbody>                                
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cedula</th>
                                        <th>Email</th>
                                        <th>Contraseña</th>
                                        <th>Rol</th>
                                        <th>Fecha Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

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
                <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButton">
                <a class="btn-crud btn-primary text-bold" href="../../cerrar.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>
  </div>

  <!-- Create Modal-->
  <div class="modal fade modal-crud" id="modalCrudAgregar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white" id="modal-register-label">Agregar Usuario</h3>
                <p class="modal">Ingrese los datos del Usuario:</p>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" class="element-white"></i>
                </button>
            </div> 
            <form class="forms-sample" id="aggUser" method="post">
            <div class="modal-body">
                <div class="grid-margin-modal">          
                    <div class="card-body">
                        <p class="card-description">Por favor, complete los siguientes campos para agregar un nuevo usuario al sistema:</p>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cedula" class="text-bold">Cedula</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="text-bold">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido" class="text-bold">Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="email" class="text-bold">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="role" class="text-bold">Rol</label>
                                <select class="form-control" name="rol" id="rol" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="laboratorista">Laboratorista</option>
                                    <option value="admin">Administrador</option>
                                    <option value="estudiante">Estudiante en Prácticas</option>
                                    <option value="reportero">Generador de Reportes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="text-bold">Contraseña</label>
                                <input type="password" class="form-control" name="InputPassword" id="InputPassword" placeholder="Contraseña" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales." oninput="validatePassword(this)" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ConfirmPassword" class="text-bold">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="ConfirmPassword" placeholder="Contraseña" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="La contraseña debe tener entre 8 y 20 caracteres, al menos una letra mayúscula y un número. No se permiten caracteres especiales." oninput="validatePassword(this); checkPasswordMatch();" required>
                                <div class="invalid-feedback" id="passwordMatchError" style="display: none;">Las contraseñas no coinciden.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButton">
                <input type="submit" class="btn-crud btn-primary text-bold" value=" Agregar Usuario ">
            </div>
          </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCrudEliminar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white" id="modal-register-label">Eliminar Usuario</h3>
                <p class="modal">Ingrese los datos del Usuario:</p>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" class="element-white"></i>
                </button>
            </div> 
            <form class="forms-sample" id="eliminarUserForm">
            <div class="modal-body">
                <div class="grid-margin-modal">          
                    <div class="card-body">
                        <p class="card-description">¿Está seguro de que desea eliminar el Usuario?</p>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButton">
                <input type="submit" class="btn-crud btn-primary text-bold" value=" Eliminar Usuario ">
            </div>
          </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white" id="modal-register-label">Editar Usuario</h3>
                <p class="modal">Ingrese los datos del Usuario:</p>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" class="element-white"></i>
                </button>
            </div> 
            <form class="forms-sample" id="editarUserForm">
            <div class="modal-body">
                <div class="grid-margin-modal">          
                    <div class="card-body">
                        <p class="card-description">Por favor, complete los siguientes campos para editar su información personal:</p>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Email" class="text-bold">Email</label>
                                <input type="email" class="form-control" id="emailE" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="role" class="text-bold">Rol</label>
                                <select class="form-control" name="rolE" id="rolE" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="laboratorista">Laboratorista</option>
                                    <option value="admin">Administrador</option>
                                    <option value="estudiante">Estudiante en Prácticas</option>
                                    <option value="reportero">Generador de Reportes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal" aria-label="Close" value="Cancelar" id="cancelButton">
                <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Usuario ">
            </div>
          </form>
        </div>
    </div>
</div>
  

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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const apiBaseUrl = '../../Acciones/RestUsers.php';
    const usersTableBody = document.getElementById('usersTableBody');
    const aggUser = document.getElementById('aggUser');
    const editarModal = new bootstrap.Modal(document.getElementById('modalCrud'));
    const eliminarModal = new bootstrap.Modal(document.getElementById('modalCrudEliminar'));

    let userAEliminarId = null;
    let userAEditarId = null;

    async function fetchUsers() {
      try {
        const response = await fetch(apiBaseUrl);
        const data = await response.json();

        usersTableBody.innerHTML = '';
        data.forEach(user => {
          const row = document.createElement('tr');
          var rol=user.rol;
          switch (rol) {
          case "admin":
                rol='Administrador';
            break;
          case "laboratorista":
              rol='Laboratorista';
          break;
          case "estudiante":
                rol='Estudiante en Prácticas';
            break;
            case "reportero":
                rol='Generador de Reportes';
            break;
        }
          row.innerHTML = `
            <td>${user.id}</td>
            <td>${user.nombre}</td>
            <td>${user.apellido}</td>
            <td>${user.cedula}</td>
            <td>${user.email}</td>
            <td>${user.psswd}</td>
            <td>${rol}</td>
            <td>${user.fecha_ingreso}</td>
            <td>
            <center>          
              <button class="btn btn-warning btn-circle element-white editar" id="editar" onclick="showEditarModal(${user.id})">
                <i class="fas fa-edit" ></i>
              </button>
              <button class="btn btn-danger btn-circle eliminar" id="eliminar" onclick="showEliminarModal(${user.id})">
                <i class="fas fa-trash"></i>
              </button>
            </center>
            </td>
          `;
          usersTableBody.appendChild(row);
        });
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    }

    aggUser.addEventListener('submit', async function (event) {
      event.preventDefault();
      const cedula = document.getElementById('cedula').value;
      const nombre = document.getElementById('nombre').value;
      const apellido = document.getElementById('apellido').value;
      const email = document.getElementById('email').value;
      const psswd = document.getElementById('InputPassword').value;
      const rol = document.getElementById('rol').value;
      try {
        const response = await fetch(apiBaseUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ cedula, nombre, apellido, email, psswd, rol})
        });

        if (response.ok) {
          // Si la solicitud es exitosa, recarga la lista de marcas
          fetchUsers();
          // Limpia los campos del formulario
          aggUser.reset();
          // Cierra el modal
          $('#modalCrudAgregar').modal('hide');
        } else {
          console.error('Error al agregar usuario:', response.statusText);
        }
      } catch (error) {
        console.error('Error al agregar usuario:', error);
      }
    });



    document.getElementById('editarUserForm').addEventListener('submit', async function (event) {
      event.preventDefault();
      // Obtener los valores actualizados del formulario
      const id = userAEditarId;
      const email = document.getElementById('emailE').value;
      const rol = document.getElementById('rolE').value;

      try {
        // Enviar la solicitud de edición al servidor
        const response = await fetch(apiBaseUrl + `?id=${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ email,rol })
        });

        if (response.ok) {
          // Si la solicitud es exitosa, recarga la lista de marcas
          fetchUsers();
          // Cierra el modal de edición
          editarModal.hide();
        } else {
          console.error('Error al editar usuer:', response.statusText);
        }
      } catch (error) {
        console.error('Error al editar user:', error);
      }
    });



    const eliminarUserForm = document.getElementById('eliminarUserForm');

    eliminarUserForm.addEventListener('submit', async function (event) {
      event.preventDefault();
      try {
        const id = userAEliminarId;
        const response = await fetch(apiBaseUrl + `?id=${id}`, {
          method: 'DELETE'
        });

        if (response.ok) {
          // Si la solicitud es exitosa, recarga la lista de marcas
          fetchUsers();
          // Cierra el modal de eliminación
          eliminarModal.hide()
        } else {
          console.error('Error al eliminar user:', response.statusText);
        }
      } catch (error) {
        console.error('Error al eliminar user:', error);
      }
    });
    window.showEditarModal = async function (id) {
      try {
        const response = await fetch(apiBaseUrl + `?id=${id}`);
        if (!response.ok) {
          throw new Error('Error al obtener detalles del usuario para editar');
        }
        const user = await response.json();
        //console.log(marca[0].nombre)
        // Llenar los campos del formulario con los detalles del user

        document.getElementById('emailE').value = user[0].email;
        document.getElementById('rolE').value = user[0].rol;
        
        userAEditarId = id; 
        // Mostrar el modal de edición
        editarModal.show();
      } catch (error) {
        console.error(error);
      }
    };


    window.showEliminarModal = function (id) {
      userAEliminarId = id;
      eliminarModal.show()
      console.log('Mostrar modal de eliminación para el ID:', id);
    };

    fetchUsers();
  });
</script>

</html>
