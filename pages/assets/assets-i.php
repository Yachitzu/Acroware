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
  <title>Gestión - Bienes Informáticos</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../resources/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../resources/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../resources/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../resources/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link href="../../resources/vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../resources/vendors/ti-icons/css/themify-icons.css">
  <!-- <link rel="stylesheet" type="text/css" href="../../resources/js/select.dataTables.min.css">-->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../resources/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon"
    href="../../resources/images/logos/Australian_STEM_Video_Game_Challenge-removebg-preview5.png" />


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

</head>


<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="../../index.php"><img
            src="../../resources/images/logos/Acroware.png" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.php"><img
            src="../../resources/images/logos/acroware-mini.png" alt="logo" /></a>
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
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
              data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
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
              <img src="../../resources/images/faces/perfil1.png" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="../others/acount.php">
                <i class="ti-settings text-primary"></i>
                Editar Perfil
              </a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
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
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
              aria-controls="todo-section" aria-expanded="true">Recordatorio</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
            aria-labelledby="todo-section">
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
                <li class="nav-item"> <a class="nav-link" href="assets-i.php">Bienes Informáticos</a></li>

                <li class="nav-item"> <a class="nav-link" href="repowering.php">Repotenciación</a></li>
                <li class="nav-item"> <a class="nav-link" href="assets-m.php">Bienes Mobiliarios</a></li>
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
            <a class="nav-link" href="../others/QR.php">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Escaneo QR</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../others/acount.php">
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
                <div class="cover-image-gest d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5">
                  <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Bienes
                    Informáticos</h1>
                  <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white" href="../../index.php">Inicio</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Gestor de Bienes</p>
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
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <button class="btn-crud btn-secondary btn-icon-split" id="agregar">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                  </span>
                  <span class="text text-white">Agregar Bien</span>
                </button>
              </div>
              <div class="card-body bg-darkwhite">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                      <tr>
                        <th>Ver Más</th>
                        <th>Codigo UTA</th>
                        <th>Nombre</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="marcasTableBody">
                      <tr>
                        <td>
                          <center>
                            <button class="btn btn-info btn-circle element-white mas" id="mas">
                              <i class="fas fa-plus"></i>
                            </button>
                          </center>
                        </td>
                        <td>UTA123456</td>
                        <td>Equipo de Computo</td>
                        <td>XPS 13</td>
                        <td>Dell</td>
                        <td>
                          <center>
                            <button class="btn btn-warning btn-circle element-white editar" id="editar">
                              <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-circle eliminar" id="eliminar">
                              <i class="fas fa-trash"></i>
                            </button>
                          </center>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <center>
                            <button class="btn btn-info btn-circle element-white mas" id="mas">
                              <i class="fas fa-plus"></i>
                            </button>
                          </center>
                        </td>
                        <td>UTA123456</td>
                        <td>Equipo de Computo</td>
                        <td>XPS 13</td>
                        <td>Dell</td>
                        <td>
                          <center>
                            <button class="btn btn-warning btn-circle element-white editar" id="editar">
                              <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-circle eliminar" id="eliminar">
                              <i class="fas fa-trash"></i>
                            </button>
                          </center>
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Ver Más</th>
                        <th>Codigo UTA</th>
                        <th>Nombre</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
          <script>
            $(document).ready(function () {
              var table = $('#dataTable').DataTable();

              // Add event listener for opening and closing details
              $('#dataTable tbody').on('click', 'button.mas', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var btn = $(this);

                if (row.child.isShown()) {
                  // This row is already open - close it
                  row.child.hide();
                  btn.find('i').removeClass('fa-minus').addClass('fa-plus');
                } else {
                  // Open this row
                  row.child(format(row.data())).show();
                  btn.find('i').removeClass('fa-plus').addClass('fa-minus');
                }
              });

              function format(rowData) {
                // Function to return the details row HTML
                // Use the appropriate indices from the original data for the additional info
                var componentsTable = `
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Serie</th>
                  <th>Código UTA</th>
                  <th>Activo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Componente 1</td>
                  <td>Descripción del componente 1</td>
                  <td>SN123</td>
                  <td>ADI456</td>
                  <th>Si</th>
                  <th>
                    <center>
                      <button class="btn btn-warning btn-circle element-white editar" id="editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-circle eliminar" id="eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </center>
                  </th>
                </tr>
                <tr>
                  <td>Componente 2</td>
                  <td>Descripción del componente 2</td>
                  <td>SN789</td>
                  <td>ADI101</td>
                  <th>Si</th>
                  <th>
                    <center>
                      <button class="btn btn-warning btn-circle element-white editarComponente" id="editarComponente" data-toggle="modal" data-target="#modalCrudEditarComponente">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-circle eliminarComponente" id="eliminarComponente" data-toggle="modal" data-target="#modalCrudEliminarComponente">
                        <i class="fas fa-trash"></i>
                      </button>
                    </center>
                  </th>
                </tr>
              </tbody>
            </table>
        `;

                return `
            <div class="additional-info">
                <div class="row info-assets">
                  <div class="col-md-3"><strong>Serie:</strong>SN12345</div>
                  <div class="col-md-3"><strong>Custodio:</strong>Juan Perez</div>
                  <div class="col-md-3"><strong>Ubicación:</strong>Oficina 101</div>
                  <div class="col-md-3"><strong>Fecha Ingreso:</strong>2024-05-22</div>
                </div>

                <button class="btn-crud btn-primary btn-icon-split" id="agregar" data-toggle="modal" data-target="#modalCrudAgregarComponente"> 
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text text-white">Agregar Componente</span>
                </button>
                ${componentsTable}
            </div>
        `;
              }

              // Event listener for adding components
              $('#dataTable tbody').on('click', '.btn-add-component', function () {
                $('#modalCrudAgregarComponente').modal('show');
              });

              // Form submission handler for adding components
              $('#agregarComponenteForm').on('submit', function (event) {
                event.preventDefault();
                $('#modalCrudAgregarComponente').modal('hide');
                alert('Componente agregado exitosamente.');
              });

              $("#eliminarComponente").click(function () {
                $("#modalCrudEliminarComponente").modal('show');
              });

              $("#editarComponente").click(function () {
                $("#modalCrudEditarComponente").modal('show');
              });

            });
          </script>


          <!-- /.container-fluid -->

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.php -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Acroware © 2024. Todos los
              derechos reservados.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Create Modal for Adding Components -->
  <div class="modal fade modal-crud" id="modalCrudAgregarComponente" tabindex="-1" role="dialog"
    aria-labelledby="modal-add-component-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-add-component-label">Agregar Componente</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="agregarComponenteForm" method="post">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para agregar un nuevo componente:
                </p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="nombreComponente" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreComponente" id="nombreComponente"
                      placeholder="Nombre" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="descripcionComponente" class="text-bold">Descripción</label>
                    <input type="text" class="form-control" name="descripcionComponente" id="descripcionComponente"
                      placeholder="Descripción" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="serieComponente" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieComponente" id="serieComponente"
                      placeholder="Serie" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoAdicionalComponente" class="text-bold">Código Adicional UTA</label>
                    <input type="text" class="form-control" name="codigoAdicionalComponente"
                      id="codigoAdicionalComponente" placeholder="Código Adicional UTA" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="repotenciadoComponente" class="text-bold">Repotenciado</label>
                    <select class="form-control" id="repotenciadoComponente" name="repotenciadoComponente" required>
                      <option value="">Seleccione</option>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="activoComponente" class="text-bold">Activo</label>
                    <select class="form-control" id="activoComponente" name="activoComponente" required>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Agregar Componente ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Create Modal for Adding Components -->
  <div class="modal fade modal-crud" id="modalEditarComponente" tabindex="-1" role="dialog"
    aria-labelledby="modal-edit-component-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-edit-component-label">Editar Componente</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="agregarComponenteForm" method="post">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar un nuevo componente:
                </p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="nombreComponente" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreComponente" id="nombreComponente"
                      placeholder="Nombre" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="descripcionComponente" class="text-bold">Descripción</label>
                    <input type="text" class="form-control" name="descripcionComponente" id="descripcionComponente"
                      placeholder="Descripción" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="serieComponente" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieComponente" id="serieComponente"
                      placeholder="Serie" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoAdicionalComponente" class="text-bold">Código Adicional UTA</label>
                    <input type="text" class="form-control" name="codigoAdicionalComponente"
                      id="codigoAdicionalComponente" placeholder="Código Adicional UTA" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="repotenciadoComponente" class="text-bold">Repotenciado</label>
                    <select class="form-control" id="repotenciadoComponente" name="repotenciadoComponente" required>
                      <option value="">Seleccione</option>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="activoComponente" class="text-bold">Activo</label>
                    <select class="form-control" id="activoComponente" name="activoComponente" required>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Componente ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal-->
  <div class="modal fade modal-crud" id="modalCrudEliminarComponente" tabindex="-1" role="dialog"
    aria-labelledby="modal-delete-component-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-delete-component-label">Eliminar Componente </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="eliminarMarcaForm">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">¿Está seguro de que desea eliminar el Componente?</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Eliminar Componente ">
          </div>
        </form>
      </div>
    </div>
  </div>

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
            <p class="card-description">Seleccione "Cerrar sesión" a continuación si está list@ para finalizar su sesión
              actual.</p>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
            aria-label="Close" value="Cancelar" id="cancelButton">
          <a class="btn-crud btn-primary text-bold" href="../../cerrar.php">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Modal-->
  <div class="modal fade modal-crud" id="modalCrudAgregar" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Agregar Bien</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="agregarMarcaForm" method="post">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para agregar un nuevo bien al
                  sistema:</p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="codigoUTAC" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAC" id="codigoUTAC" placeholder="Código UTA"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreC" id="nombreC" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="codigoUTAC" id="codigoUTAC" placeholder="Serie"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Marca</label>
                    <select class="form-control" id="facultad" required>
                      <option value="">Seleccione una Marca</option>
                      <option value="HP">HP</option>
                      <option value="Dell">DELL</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="codigoUTAC" id="codigoUTAC" placeholder="Modelo"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Facultad</label>
                    <select class="form-control" id="facultad" required>
                      <option value="">Seleccione una Facultad</option>
                      <option value="FISEI">Facultad de Ingenieria en Sistemas, Electronica e Industrial</option>
                      <option value="FDA">Facultad de Diseño y Arquitectura</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicación" required>
                      <option value="">Seleccione una Ubicación</option>
                      <option value="Aula01">Aula 01</option>
                      <option value="Aula02">Aula 02</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold agregarBien" value=" Agregar Bien "
              id="agregarBien">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal-->
  <div class="modal fade" id="modalCrudEliminar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Eliminar Bien </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="eliminarMarcaForm">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">¿Está seguro de que desea eliminar el Bien?</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Eliminar Bien ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label"> QR Bien Informático </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>

        <div class="modal-body">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 text-center">
                <img src="../../resources/images/logos/OIP.jpg" alt="Código QR" class="img-fluid">
              </div>
              <div class="col-md-6">
                <ul>
                  <li><strong>Código UTA:</strong> UTA123456</li>
                  <li><strong>Nombre:</strong> Equipo de Computo</li>
                  <li><strong>Modelo:</strong> XPS 13</li>
                  <li><strong>Marca:</strong> Dell</li>
                  <li><strong>Custodio:</strong> Juan Perez</li>
                  <li><strong>Ubicación:</strong> Oficina-01</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
            aria-label="Close" value="Cerrar Modal" id="cancelButton">
          <button class="btn-crud btn-primary text-bold">
            <i class="fas fa-download"></i> Descargar QR
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalQREditar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label"> QR Bien Informático </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>

        <div class="modal-body">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 text-center">
                <img src="../../resources/images/logos/OIP.jpg" alt="Código QR" class="img-fluid">
              </div>
              <div class="col-md-6">
                <ul>
                  <li><strong>Código UTA:</strong> UTA123456</li>
                  <li><strong>Nombre:</strong> Equipo de Computo</li>
                  <li><strong>Modelo:</strong> XPS 13</li>
                  <li><strong>Marca:</strong> Dell</li>
                  <li><strong>Custodio:</strong> Juan Perez</li>
                  <li><strong>Ubicación:</strong> Oficina-01</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
            aria-label="Close" value="Cerrar Modal" id="cancelButton">
          <button class="btn-crud btn-primary text-bold">
            <i class="fas fa-download"></i> Descargar QR
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal-->
  <div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Editar Bien</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="editarMarcaForm">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar la información del
                  bien seleccionado:</p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="codigoUTAC" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAC" id="codigoUTAC" placeholder="Código UTA"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreC" id="nombreC" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="codigoUTAC" id="codigoUTAC" placeholder="Serie"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Marca</label>
                    <select class="form-control" id="facultad" required>
                      <option value="">Seleccione una Marca</option>
                      <option value="HP">HP</option>
                      <option value="Dell">DELL</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="codigoUTAC" id="codigoUTAC" placeholder="Modelo"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Facultad</label>
                    <select class="form-control" id="facultad" required>
                      <option value="">Seleccione una Facultad</option>
                      <option value="FISEI">Facultad de Ingenieria en Sistemas, Electronica e Industrial</option>
                      <option value="FDA">Facultad de Diseño y Arquitectura</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicación" required>
                      <option value="">Seleccione una Ubicación</option>
                      <option value="Aula01">Aula 01</option>
                      <option value="Aula02">Aula 02</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold editarBien" id="editarBien" value=" Editar Bien">
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
  <!-- <script src="../../resources/js/dataTables.select.min.js"></script>-->

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../resources/js/off-canvas.js"></script>
  <script src="../../resources/js/modal.js"></script>
  <script src="../../resources/js/validation.js"></script>
  <script src="../../resources/js/hoverable-collapse.js"></script>
  <script src="../../resources/js/template.js"></script>
  <script src="../../resources/js/settings.js"></script>
  <!-- <script src="../../resources/js/todolist.js"></script>-->
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- <script src="../../resources/js/dashboard.js"></script>-->
  <script src="../../resources/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

  <!-- Page level plugins -->
  <script src="../../resources/vendors/datatables/jquery.dataTables.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../resources/js/datatables-demo.js"></script>
</body>

</html>