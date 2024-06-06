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
  <title>Reportes</title>
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
  <link rel="shortcut icon"
    href="../../resources/images/logos/Australian_STEM_Video_Game_Challenge-removebg-preview5.png" />
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
        <nav class="sidebar sidebar-offcanvas " id="sidebar">
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
                <a class="nav-link" href="report.php">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Reportes</span>
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
                    <i class="icon-head menu-icon"></i>
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
                  <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Reportes</h1>
                  <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white" href="../../index.php">Inicio</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Registro de Reportes</p>
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
              <div class="row">
                <!-- Card 1: Bienes Informáticos -->
                <div class="col-md-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4 font-berthold-small">Bienes Informáticos</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fs-30 mb-2"><i class="ti-desktop"></i> </p>
                                <button class="btn btn-primary text-bold generar-reporte-info" id="generar-reporte-info">
                                    Generar Reporte  <i class="fas fa-file-alt"></i>
                                </button>
                            </div>
                            <p>Tipo Reporte</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2: Bienes Mobiliarios -->
                <div class="col-md-4 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4 font-berthold-small">Bienes Mobiliarios</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fs-30 mb-2"><i class="ti-panel"></i> </p>
                                <button class="btn btn-primary text-bold generar-reporte-mobi" id="generar-reporte-mobi">
                                    Generar Reporte  <i class="fas fa-file-alt"></i>
                                </button>
                            </div>
                            <p>Tipo Reporte</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3: Software -->
                <div class="col-md-4 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4 font-berthold-small">Software</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fs-30 mb-2"><i class="ti-layers"></i> </p>
                                <button class="btn btn-primary text-bold generar-reporte-sof" id="generar-reporte-sof">
                                    Generar Reporte  <i class="fas fa-file-alt"></i>
                                </button>
                            </div>
                            <p>Tipo Reporte</p>
                        </div>
                    </div>
                </div>
            </div>
              </div>
              <div class="card-body bg-darkwhite">
                <div class="table-responsive">
                  <!-- <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo Reporte</th>
                            <th>Extensión</th>
                            <th>Fecha Generación</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Reporte_Bienes01</th>
                            <th>B. Informaticos</th>
                            <th>PDF</th>
                            <th>2024/05/15</th>
                            <th>Christian</th>
                            <th>
                                <center>
                                    <button class="btn btn-danger btn-circle eliminar" data-id="' . $respuesta['id'] . '" id="eliminar">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </center>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo Reporte</th>
                            <th>Extensión</th>
                            <th>Fecha Generación</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                  </table> -->
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

  <!-- Create Modal-->
  <div class="modal fade modal-crud" id="modalInfo" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Reportes B. Informáticos</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="repBInformaticos" method="post" action= "../../Acciones/ReporteBI.php" target="_blank">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para generar un reporte:</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="areaC" class="text-bold">Área</label>
                    <select class="form-control" name="areaI" id="areaC" required>
                      <option value="">Seleccione un Área</option>
                          <option value="any">Todos</option>
                          <?php
                            include_once ("../../Acciones/crudMarcas.php");
                            $areas = Obtener::ObtenerArea();
                            echo ($areas['dato']);
                          ?>
                    </select>
                  </div>
                    <div class="form-group col-md-6">
                        <label for="areaC" class="text-bold">Marca</label>
                        <select class="form-control" name="marcaI" id="areaC" required>
                        <option value="">Seleccione una marca</option>
                        <option value="any">Todos</option>
                          <?php
                          include_once ("../../Acciones/crudMarcas.php");
                          $marcas = Obtener::ObtenerNombreT();
                          echo ($marcas['dato']);
                          ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fechaInicialI" class="text-bold">Fecha Inicial</label>
                        <input type="date" class="form-control" name="fechaInicialI" id="fechaInicialI" placeholder="Selecciona una fecha" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fechaFinalI" class="text-bold">Fecha Final</label>
                        <input type="date" class="form-control" name="fechaFinalI" id="fechaFinalI" placeholder="Selecciona una fecha" required>
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="tipoI" class="text-bold">Tipo Archivo</label>
                    <select class="form-control" name="tipoArchivoI" id="tipoI" required>
                      <option value="">Seleccione un Tipo</option>
                      <option value="pdf">PDF</option>
                      <option value="excel">Excel</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Generar Reporte ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Create Modal-->
  <div class="modal fade modal-crud" id="modalMobi" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Reportes B. Mobiliarios</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="repBMobiliarios" method="post" action= "../../Acciones/ReporteBM.php" target="_blank">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, seleccione los siguientes filtros para generar un reporte:</p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="custodioM" class="text-bold">Custodio</label>
                    <select class="form-control" name="custodioM" id="custodioM" required>
                      <option value="">Seleccione un Custodio</option>
                      <option value="any">Todos</option>
                      <?php
                          include_once ("../../Acciones/crudMarcas.php");
                          $users = Obtener::ObtenerCustodios();
                          echo ($users['dato']);
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="areaC" class="text-bold">Área</label>
                    <select class="form-control" name="areaM" id="areaC" required>
                      <option value="">Seleccione un Área</option>
                      <option value="any">Todos</option>
                      <?php
                          include_once ("../../Acciones/crudMarcas.php");
                          $areas = Obtener::ObtenerArea();
                          echo ($areas['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="areaC" class="text-bold">Marca</label>
                    <select class="form-control" name="marcaM" id="areaC" required>
                      <option value="">Seleccione una Marca</option>
                      <option value="any">Todos</option>
                      <?php
                          include_once ("../../Acciones/crudMarcas.php");
                          $marcas = Obtener::ObtenerNombreM();
                          echo ($marcas['dato']);
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fechaInicial" class="text-bold">Fecha Inicial</label>
                        <input type="date" class="form-control" name="fechaInicialM" id="fechaInicialM" placeholder="Selecciona una fecha" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fechaFinal" class="text-bold">Fecha Final</label>
                        <input type="date" class="form-control" name="fechaFinalM" id="fechaFinalM" placeholder="Selecciona una fecha" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="areaC" class="text-bold">Tipo Archivo</label>
                        <select class="form-control" name="tipoArchivoBM" id="areaC" required>
                        <option value="">Seleccione un Tipo</option>
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Generar Reporte ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Create Modal-->
  <div class="modal fade modal-crud" id="modalSoft" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Reportes Software</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form action= "../../Acciones/ReporteSW.php" class="forms-sample" id="reporteSwForm" method="post" target="_blank">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, seleccione los siguientes filtros para generar un reporte:</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="areaC" class="text-bold">Tipo Licencia</label>
                    <select class="form-control" name="licenciaSW" id="licenciaSW" required>
                      <option value="">Seleccione una licencia</option>
                      <option value="any">Todos</option>
                      <option value="Dominio Público">Dominio Público</option>
                      <option value="Codigo Abierto">Codigo Abierto</option>
                      <option value="Suscripción">Suscripción</option>
                      <option value="Propietario">Propietario</option>
                      <option value="Gratuito">Gratuito</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="activoSW" class="text-bold">Activado</label>
                    <select class="form-control" name="activoSW" id="activoSW" required>
                      <option value="">Seleccione un estado</option>
                      <option value="any">Todos</option>
                      <option value="si">Si</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fechaInicial" class="text-bold">Fecha Inicial</label>
                        <input type="date" class="form-control" name="fechaInicialSW" id="fechaInicialSW" placeholder="Selecciona una fecha" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fechaFinal" class="text-bold">Fecha Final</label>
                        <input type="date" class="form-control" name="fechaFinalSW" id="fechaFinalSW" placeholder="Selecciona una fecha" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="areaC" class="text-bold" >Tipo Archivo</label>
                        <select class="form-control" name="tipoArchivoSW" id="tipoArchivoSW" required>
                          <option value="">Seleccione un Tipo</option>
                          <option value="pdf">PDF</option>
                          <option value="excel">Excel</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" id='reporteSW' value=" Generar Reporte ">
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
  <script src="../../resources/js/todolist.js"></script>
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


  <script>
    document.getElementById('fechaInicialSW').addEventListener('change', function() {
      var fecha_adqui = document.getElementById('fechaInicialSW').value;
      document.getElementById('fechaFinalSW').min = fecha_adqui;
  });

  document.getElementById('fechaFinalSW').addEventListener('change', function() {
      var fecha_activacion = document.getElementById('fechaFinalSW').value;
      var fecha_adqui = document.getElementById('fechaInicialSW').value;
      if (fecha_activacion < fecha_adqui) {
          alert('La fecha final no puede ser anterior a la fecha inicial.');
          document.getElementById('fechaFinalSW').value = '';
      }
 feature-funcionReportes
  });
  </script>
  <script>
    document.getElementById('fechaInicialI').addEventListener('change', function() {
      var fecha_adqui = document.getElementById('fechaInicialI').value;
      document.getElementById('fechaFinalI').min = fecha_adqui;
  });

  document.getElementById('fechaFinalI').addEventListener('change', function() {
      var fecha_activacion = document.getElementById('fechaFinalI').value;
      var fecha_adqui = document.getElementById('fechaInicialI').value;
      if (fecha_activacion < fecha_adqui) {
          alert('La fecha final no puede ser anterior a la fecha inicial.');
          document.getElementById('fechaFinalI').value = '';
      }
  });
  </script>
  <script>
    document.getElementById('fechaInicialM').addEventListener('change', function() {
      var fecha_adqui = document.getElementById('fechaInicialM').value;
      document.getElementById('fechaFinalM').min = fecha_adqui;
  });

  document.getElementById('fechaFinalM').addEventListener('change', function() {
      var fecha_activacion = document.getElementById('fechaFinalM').value;
      var fecha_adqui = document.getElementById('fechaInicialM').value;
      if (fecha_activacion < fecha_adqui) {
          alert('La fecha final no puede ser anterior a la fecha inicial.');
          document.getElementById('fechaFinalM').value = '';
      }
  });
  </script>

</html>