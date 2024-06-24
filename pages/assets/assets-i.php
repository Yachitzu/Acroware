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
require_once '../../Acciones/contador.php';
$usuario_id = $_SESSION['id'];
$recordatorios = obtenerRecordatoriosPendientes($usuario_id);
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
              <i class="fa fa-tasks"></i>
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
                  <input type="hidden" class="todo-list-input_id" name="usuario_id" value="<?php echo $usuario_id; ?>">
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <?php if (is_array($recordatorios) && count($recordatorios) > 0): ?>
                  <?php foreach ($recordatorios as $recordatorio): ?>
                    <li data-id="<?php echo $recordatorio['id']; ?>">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox" <?php echo $recordatorio['estado'] == 'finalizado' ? 'checked' : ''; ?>>
                          <?php echo htmlspecialchars($recordatorio['actividad']); ?>
                        </label>
                      </div>
                      <i class="remove ti-close"></i>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li>No se encontraron recordatorios pendientes.</li>
                <?php endif; ?>
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
            <a class="nav-link" href="../others/report.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Reporte</span>
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
                <button class="btn-crud btn-secondary btn-icon-split" id="AgregarBienes">
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
                    <tbody id="bienesTableBody">
                      <!-- Aquí se insertará la lista de bienes informáticos -->
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
    aria-labelledby="modal-add-register-label" aria-hidden="true">
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

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Agregar Componente ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Create Modal for Adding Components -->
  <div class="modal fade modal-crud" id="modalCrudEditarComponente" tabindex="-1" role="dialog"
    aria-labelledby="modal-edit-component-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-edit-component-label">Editar Componente</h3>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="editarComponenteForm" method="post">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar un nuevo componente:
                </p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="nombreComponenteE" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreComponenteE" id="nombreComponenteE"
                      placeholder="Nombre" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="descripcionComponenteE" class="text-bold">Descripción</label>
                    <input type="text" class="form-control" name="descripcionComponenteE" id="descripcionComponenteE"
                      placeholder="Descripción" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="serieComponenteE" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieComponenteE" id="serieComponenteE"
                      placeholder="Serie" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoAdicionalComponenteE" class="text-bold">Código Adicional UTA</label>
                    <input type="text" class="form-control" name="codigoAdicionalComponenteE"
                      id="codigoAdicionalComponenteE" placeholder="Código Adicional UTA" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="repotenciadoComponenteE" class="text-bold">Repotenciado</label>
                    <select class="form-control" id="repotenciadoComponenteE" name="repotenciadoComponenteE" required>
                      <option value="">Seleccione</option>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
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
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="eliminarComponenteForm">
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
          <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
            aria-label="Close" value="Cancelar" id="cancelButton">
          <a class="btn-crud btn-primary text-bold" href="../../cerrar.php">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>
  <!-- BIENES INFORMÁTICOS -->
  <!-- Create Modal-->
  <div class="modal fade modal-crud" id="modalCrudAgregarBienes" tabindex="-1" role="dialog"
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
        <form class="forms-sample" id="formAgregarBienes">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para agregar un nuevo bien al
                  sistema:</p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="codigoUTAC" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAA" id="codigoUTAA" placeholder="Código UTA"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreA" id="nombreA" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieA" id="serieA" placeholder="Serie" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Marca</label>
                    <select class="form-control" id="marcaA" required>
                      <option value="">Seleccione una Marca</option>
                      <?php
                      include_once ("../../Acciones/crudBienes_Informaticos.php");
                      $marcas = AccionesBienes_Informaticos::listarMarcasInsertar();
                      echo ($marcas['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="modeloA" id="modeloA" placeholder="Modelo" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Areas</label>
                    <select class="form-control" id="areaA" required>
                      <option value="">Seleccione una área</option>
                      <?php
                      $areas = AccionesBienes_Informaticos::listarAreasInsertar();
                      echo ($areas['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicacionA" required>
                      <option value="">Seleccione una Ubicación</option>
                      <?php
                      $ubicaciones = AccionesBienes_Informaticos::listarUbicacionesInsertar();
                      echo ($ubicaciones['dato']);
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <label for="usuario" class="text-bold">Laboratorista Encargado</label>
                  <select class="form-control" id="usuarioA" required>
                    <option value="">Seleccione un Laboratorista</option>
                    <?php
                    $usuarios = AccionesBienes_Informaticos::listarUsuariosInsertar();
                    echo ($usuarios['dato']);
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold agregarBien" value=" Agregar Bien ">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Modal-->
  <div class="modal fade" id="modalCrudEliminarBienes" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Eliminar Bien </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="formEliminarBienes">
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
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Eliminar Bien ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Modal-->
  <!-- Edit Modal-->
  <div class="modal fade" id="modalCrudEditarBienes" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
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
        <form class="forms-sample" id="formEditarBienes">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar la información del
                  bien seleccionado:</p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="codigoUTAC" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAE" id="codigoUTAE" placeholder="Código UTA"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreE" id="nombreE" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieE" id="serieE" placeholder="Serie" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Marca</label>
                    <select class="form-control" id="marcaE" required>
                      <?php
                      $marcasE = AccionesBienes_Informaticos::listarMarcasInsertar();
                      echo ($marcasE['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="modeloE" id="modeloE" placeholder="Modelo" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Areas</label>
                    <select class="form-control" id="areaE" required>
                      <?php
                      $areasE = AccionesBienes_Informaticos::listarAreasInsertar();
                      echo ($areasE['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicacionE" required>
                      <?php
                      $ubicacionesE = AccionesBienes_Informaticos::listarUbicacionesInsertar();
                      echo ($ubicacionesE['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="usuario" class="text-bold">Laboratorista Encargado</label>
                    <select class="form-control" id="usuarioE" required>
                      <?php
                      $usuarios = AccionesBienes_Informaticos::listarUsuariosInsertar();
                      echo ($usuarios['dato']);
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold editarBien" value=" Editar Bien">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- CODIGO QR -->

  <div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label"> QR Bien Informático </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
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
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
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



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function () {
      // Inicializa la tabla pero no la guardes en una variable
      // porque se reconstruirá después de cada carga de datos.
      $('#dataTable').DataTable();

      // Cargar la tabla cuando se cargue el DOM
      cargarTabla();

      $("#AgregarBienes").click(function () {
        $("#modalCrudAgregarBienes").modal('show');
      });

      $("#formAgregarBienes").submit(function (e) {
        //e.preventDefault();
        let codigo_uta = $("#codigoUTAA").val();
        let nombre = $("#nombreA").val();
        let serie = $("#serieA").val();
        let id_marca = $("#marcaA").val();
        let modelo = $("#modeloA").val();
        let id_area_per = $("#areaA").val();
        let id_ubi_per = $("#ubicacionA").val();
        let custodio = $("#usuarioA").val();
        $.ajax({
          url: "../../Acciones/RestBienes_Informaticos.php",
          type: "POST",
          data: JSON.stringify({
            codigo_uta: codigo_uta,
            nombre: nombre,
            serie: serie,
            id_marca: id_marca,
            modelo: modelo,
            id_area_per: id_area_per,
            id_ubi_per: id_ubi_per,
            custodio: custodio
          }),
          contentType: "application/json",
          cache: false,
          error: function (error) {
            console.error("Error en la solicitud AJAX", error);
          },
          complete: function () {
            $("#modalCrudAgregarBienes").modal('hide');
            $("#codigoUTAA").val("");
            $("#nombreA").val("");
            $("#serieA").val("");
            $("#marcaA").val("");
            $("#modeloA").val("");
            $("#areaA").val("");
            $("#ubicacionA").val("");
            $("#usuarioA").val("");
            cargarTabla();
          }
        });
      });

      function cargarTabla() {
        fetch('../../Acciones/RestBienes_Informaticos.php?op=GET', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json'
          }
        })
          .then(response => response.json())
          .then(data => {
            const tbody = document.querySelector('#dataTable tbody');
            if ($.fn.DataTable.isDataTable('#dataTable')) {
              $('#dataTable').DataTable().destroy();
            }
            tbody.innerHTML = '';

            if (data.codigo === 0) {
              data.datos.forEach(respuesta => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                  <td>
                      <center>
                          <button class="btn btn-info btn-circle element-white mas" id="mas" data-id="${respuesta.id}">
                              <i class="fas fa-plus"></i>
                          </button>
                      </center>
                  </td>
                  <td>${respuesta.codigo_uta}</td>
                  <td>${respuesta.nombre}</td>
                  <td>${respuesta.modelo}</td>
                  <td>${respuesta.nombre_marca}</td>
                  <td class="mdl-data-table__cell">
                      <center>
                          <button class="btn btn-warning btn-circle element-white editar" data-id="${respuesta.id}">
                              <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-danger btn-circle eliminar" data-id="${respuesta.id}">
                              <i class="fas fa-trash"></i>
                          </button>
                      </center>
                  </td>
                  <input type="hidden" class="serie" value="${respuesta.serie}">
                  <input type="hidden" class="id_marca" value="${respuesta.id_marca}">
                  <input type="hidden" class="id_area_per" value="${respuesta.id_area_per}">
                  <input type="hidden" class="id_bien" value="${respuesta.id}">
                  <input type="hidden" class="id_ubi_per" value="${respuesta.id_ubi_per}">
                  <input type="hidden" class="custodio" value="${respuesta.custodio}">
              `;
                tr.dataset.area = respuesta.nombre_area;
                tr.dataset.bloque = respuesta.nombre_bloque;
                tbody.appendChild(tr);
              });
            } else {
              const tr = document.createElement('tr');
              const td = document.createElement('td');
              td.textContent = 'No se encontraron facultades.';
              td.setAttribute('colspan', '6');
              tr.appendChild(td);
              tbody.appendChild(tr);
            }

            const dataTable = $('#dataTable').DataTable({
              language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                  "first": "Primero",
                  "last": "Último",
                  "next": "Siguiente",
                  "previous": "Anterior"
                }
              },
              initComplete: function () {
                // Insertar el campo de búsqueda por bloque antes del campo de búsqueda general
                $('#dataTable_filter').append('<label style="margin-left: 10px;">Buscar por marcas:<input type="text" id="searchMarcas" class="form-control input-sm" placeholder="Buscar por marcas" style="display: inline-block; width: auto; height: 30px; padding: 2px 5px; margin-left: 5px;"></label>');
                // Agregar evento de búsqueda al campo de búsqueda por bloque
                $('#searchMarcas').on('keyup', function () {
                  dataTable.column(4).search(this.value).draw(); // 2 es el índice de la columna de facultades/bloques
                });

                $('#dataTable_filter').append('<label style="margin-left: 10px;">Buscar por Área:<input type="text" id="searchArea" class="form-control input-sm" placeholder="Buscar por Área" style="display: inline-block; width: auto; height: 30px; padding: 2px 5px; margin-left: 5px;"></label>');
                $('#dataTable_filter').append('<label style="margin-left: 10px;">Buscar por Bloques:<input type="text" id="searchBloques" class="form-control input-sm" placeholder="Buscar por Bloques" style="display: inline-block; width: auto; height: 30px; padding: 2px 5px; margin-left: 5px;"></label>');

                // Agregar evento de búsqueda al campo de búsqueda por Área
                $('#searchArea').on('keyup', function () {
                  dataTable.draw();
                });

                // Agregar evento de búsqueda al campo de búsqueda por Bloques
                $('#searchBloques').on('keyup', function () {
                  dataTable.draw();
                });
              }
            });
            $.fn.dataTable.ext.search.push(
              function (settings, data, dataIndex) {
                const areaValue = $('#searchArea').val().toLowerCase();
                const bloqueValue = $('#searchBloques').val().toLowerCase();
                const row = dataTable.row(dataIndex).node();
                const rowArea = $(row).data('area').toString().toLowerCase();
                const rowBloque = $(row).data('bloque').toString().toLowerCase();

                if (
                  (areaValue === '' || rowArea.includes(areaValue)) &&
                  (bloqueValue === '' || rowBloque.includes(bloqueValue))
                ) {
                  return true;
                }
                return false;
              }
            );

            // Agregar event listeners a los botones después de cargar la tabla
            addEventListeners();
          })
          .catch(error => {
            console.error('Error:', error);
            const tbody = document.querySelector('#dataTable tbody');
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.textContent = 'Error al cargar los datos.';
            td.setAttribute('colspan', '6');
            tr.appendChild(td);
            tbody.appendChild(tr);
          });
      }

      function addEventListeners() {
        let id = "";
        $(document).on('click', '.editar', function () {
          id = $(this).data("id");
          let fila = $(this).closest("tr");
          let codigo_uta = fila.find('td:eq(1)').text();
          let nombre = fila.find('td:eq(2)').text();
          let modelo = fila.find('td:eq(3)').text();
          let id_marca = fila.find('.id_marca').val();
          let serie = fila.find('.serie').val();
          let id_area_per = fila.find('.id_area_per').val();
          let id_ubi_per = fila.find('.id_ubi_per').val();
          let custodio = fila.find('.custodio').val();

          $("#codigoUTAE").val(codigo_uta);
          $("#nombreE").val(nombre);
          $("#modeloE").val(modelo);
          $("#marcaE").val(id_marca);
          $("#areaE").val(id_area_per);
          $("#ubicacionE").val(id_ubi_per);
          $("#serieE").val(serie);
          $("#usuarioE").val(custodio)

          $("#modalCrudEditarBienes").modal('show');
        });

        $("#formEditarBienes").submit(function (e) {
          /* e.preventDefault(); */
          let codigo_uta = $("#codigoUTAE").val();
          let nombre = $("#nombreE").val();
          let modelo = $("#modeloE").val();
          let id_marca = $("#marcaE").val();
          let serie = $("#serieE").val();
          let id_area_per = $("#areaE").val();
          let id_ubi_per = $("#ubicacionE").val();
          let custodio = $("#usuarioE").val();
          $.ajax({
            url: "../../Acciones/RestBienes_Informaticos.php",
            type: "PUT",
            data: JSON.stringify({
              id: id,
              codigo_uta: codigo_uta,
              nombre: nombre,
              modelo: modelo,
              id_marca: id_marca,
              serie: serie,
              id_area_per: id_area_per,
              id_ubi_per: id_ubi_per,
              custodio: custodio
            }),
            contentType: "application/json",
            error: function (error) {
              console.error("Error en la solicitud AJAX", error);
            },
            complete: function () {
              $("#modalCrudEditarBienes").modal('hide');
              cargarTabla();
            }
          });
        });

        $(document).on('click', '.eliminar', function () {
          id = $(this).data("id");
          $("#modalCrudEliminarBienes").modal('show');
        });

        $("#formEliminarBienes").submit(function (e) {
          //e.preventDefault();

          $.ajax({
            url: "../../Acciones/RestBienes_Informaticos.php",
            type: "DELETE",
            data: JSON.stringify({
              id: id
            }),
            contentType: "application/json",
            error: function (error) {
              console.error("Error en la solicitud AJAX", error);
            },
            complete: function () {
              $("#modalCrudEliminarBienes").modal('hide');
              cargarTabla();
            }
          });
        });

        let currentId = null;
        // Listener para el botón "mas"
        $('#dataTable tbody').on('click', 'button.mas', function () {
          var btn = $(this);
          var tr = btn.closest('tr');
          var row = $('#dataTable').DataTable().row(tr);
          var id = btn.data('id'); // Aquí se obtiene el ID del atributo data-id del botón
          currentId = id;

          if (row.child.isShown()) {
            row.child.hide();
            btn.find('i').removeClass('fa-minus').addClass('fa-plus');
          } else {
            $.ajax({
              url: '../../Acciones/DetallesInformaticos.php',
              method: 'GET',
              data: {
                id: id
              },
              success: function (response) {
                try {
                  response = JSON.parse(response);
                  if (response.codigo === 0) {
                    var detalle = response.dato;
                    var detalleHtml = `
                                    <div class="additional-info">
                                        <!-- Aquí se incluyen los detalles adicionales -->
                                        <div class="row info-assets">
                                            <div class="col-md-3"><strong>Serie:</strong> ${detalle.serie}</div>
                                            <div class="col-md-3"><strong>Ubicación:</strong> ${detalle.nombre_ubicacion}</div>
                                            <div class="col-md-3"><strong>Custodio:</strong> ${detalle.nombre_usuario} ${detalle.apellido_usuario}</div>
                                            <div class="col-md-3"><strong>Fecha Ingreso:</strong> ${detalle.fecha_ingreso}</div>
                                            <div class="col-md-3"><img src="../${detalle.qr}" alt="QR" class="image_qr" /></div>
                                        </div>
                                        <button class="btn-crud btn-primary btn-icon-split btn-add-component " id="agregarComponente" data-toggle="modal" data-target="#modalCrudAgregarComponente"> 
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus-circle"></i>
                                            </span>
                                            <span class="text text-white">Agregar Componente</span>
                                        </button>
                                        ${detalle.componentsTable} <!-- Aquí se incluye la tabla de componentes -->
                                    </div>
                                `;
                    row.child(detalleHtml).show();
                    btn.find('i').removeClass('fa-plus').addClass('fa-minus');
                  } else {
                    console.error('Error al obtener detalles del bien informático:', response.mensaje);
                  }
                } catch (e) {
                  console.error('Error al parsear JSON:', e);
                  console.error('Respuesta recibida:', response);
                }
              },
              error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
              }
            });
          }
        });




        const agregarComponenteForm = document.getElementById('agregarComponenteForm');

        let componenteAEliminarId = null;
        let componenteAEditarId = null;
        // Event listener for adding components
        $('#dataTable tbody').on('click', '.btn-add-component', function () {

          $('#modalCrudAgregarComponente').modal('show');
        });



        let isSubmitting = false;
        // Form submission handler for adding components
        $('#agregarComponenteForm').on('submit', async function (event) {
          //event.preventDefault();

          var id = currentId;

          if (isSubmitting) {
            console.log('Ya se está procesando una solicitud. Por favor, espera.');
            return;
          }

          isSubmitting = true;



          console.log(id);
          const nombre = document.getElementById('nombreComponente').value;
          const descripcion = document.getElementById('descripcionComponente').value;
          const serie = document.getElementById('serieComponente').value;
          const codigo_adi_uta = document.getElementById('codigoAdicionalComponente').value;
          const repotenciado = document.getElementById('repotenciadoComponente').value;
          const id_bien_infor_per = id;
          alert( id_bien_infor_per);
          try {
            const response = await fetch('../../Acciones/RestComponentes.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                nombre,
                descripcion,
                serie,
                codigo_adi_uta,
                repotenciado,
                id_bien_infor_per
              })
            });

            if (response.ok) {
              await cargarTabla();
              agregarComponenteForm.reset();

              $('#modalCrudAgregarComponente').modal('hide');
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
            } else {
              console.error('Error al agregar componente: ', response.statusText);
            }
          } catch (error) {
            console.error('Error al cargar componente: ', error)
          } finally {
            // Rehabilitar el botón de envío
            isSubmitting = false;

          }

        });





        document.getElementById('editarComponenteForm').addEventListener('submit', async function (event) {
          //event.preventDefault();
          var btn = $('button.mas');
          var idBien = btn.data('id');
          const id = componenteAEditarId;
          console.log('Esta id: xd: ' + id);
          const nombre = document.getElementById('nombreComponenteE').value;
          const descripcion = document.getElementById('descripcionComponenteE').value;
          const serie = document.getElementById('serieComponenteE').value;
          const codigo_adi_uta = document.getElementById('codigoAdicionalComponenteE').value;
          const repotenciado = document.getElementById('repotenciadoComponenteE').value;
          const id_bien_infor_per = idBien;
          try {
            // Enviar la solicitud de edición al servidor
            const response = await fetch('../../Acciones/RestComponentes.php' + `?id=${id}`, {
              method: 'PUT',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                id,
                nombre,
                descripcion,
                serie,
                codigo_adi_uta,
                repotenciado,
                id_bien_infor_per
              })
            });

            if (response.ok) {
              const result = await response.json();
              if (result.success) {
                // Si la solicitud es exitosa, recarga la lista de marcas
                await cargarTabla();
                // Cierra el modal de edición
                $("#modalCrudEditarComponente").modal('hide');
              } else {
                console.error('Error al editar componente:', result.message);
              }
            } else {
              console.error('Error al editar componente:', response.statusText);
            }
          } catch (error) {
            console.error('Error al editar componente:', error);
          }
        });


        window.showEditarModalComponente = async function (id) {
          try {
            const response = await fetch('../../Acciones/RestComponentes.php' + `?id=${id}`);
            if (!response.ok) {
              throw new Error('Error al obtener detalles de componentes para editar');
            }
            const responseComponente = await response.json();
            const componente = responseComponente.data;
            console.log(componente)
            // Llenar los campos del formulario con los detalles de la componente

            document.getElementById('nombreComponenteE').value = componente.nombre;
            document.getElementById('descripcionComponenteE').value = componente.descripcion;
            document.getElementById('serieComponenteE').value = componente.serie;
            document.getElementById('codigoAdicionalComponenteE').value = componente.codigo_adi_uta;
            const selectedRepotenciado = componente.repotenciado;
            const repotenciadoEInput = document.getElementById('repotenciadoComponenteE');

            // Iteramos sobre cada opción en el campo de selección
            for (let i = 0; i < repotenciadoEInput.options.length; i++) {
              // Si el valor de la opción coincide con el valor seleccionado previamente
              if (repotenciadoEInput.options[i].value === selectedRepotenciado) {
                // Marcamos esta opción como seleccionada
                repotenciadoEInput.options[i].selected = true;
                // Salimos del bucle ya que hemos encontrado la opción correcta
                break;
              }
            }
            componenteAEditarId = id;

            // Mostrar el modal de edición
            $("#modalCrudEditarComponente").modal('show');
          } catch (error) {
            console.error(error);
          }
        };
      }

      const eliminarComponenteForm = document.getElementById('eliminarComponenteForm');
      eliminarComponenteForm.addEventListener('submit', async function (event) {
        try {
          const id = componenteAEliminarId;

          if (!id) {
            console.error('ID de componente a eliminar no está definido.');
            return;
          }

          const response = await fetch('../../Acciones/RestComponentes.php' + `?id=${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json'
            }
          });

          if (response.ok) {
            const responseData = await response.json();
            if (responseData.success) {
              // Si la solicitud es exitosa, recarga la lista de marcas
              await cargarTabla();
              // Cierra el modal de eliminación
              $("#modalCrudEliminarComponente").modal('hide');

            } else {
              console.error('Error al eliminar componente:', responseData.message || response.statusText);
              alert(responseData.message)
            }
          }
        } catch (error) {
          console.error('Error al eliminar componente:', error);
        }
      });

      window.showEliminarModalComponente = function (id) {
        componenteAEliminarId = id;
        $("#modalCrudEliminarComponente").modal('show');
        console.log('Mostrar modal de eliminación para componente con id: ', id);

      }
    });
  </script>

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
  <script src="../../resources/js/todolist.js"></script>
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