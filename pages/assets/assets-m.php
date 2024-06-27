<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['email']) || (($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'laboratorista') && $_SESSION['rol'] != 'estudiante')) {
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
  <title>Gestión - Bienes Mobiliarios</title>
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
</head>


<body> <input type="hidden" id='rolUser' value="<?php echo  $_SESSION['rol']; ?>" />
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

          <?php if ($_SESSION['rol'] == 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="../management/users.php">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Usuarios</span>
              </a>
            </li>
          <?php endif; ?>

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

          <?php if($_SESSION['rol'] == 'admin') echo '<li class="nav-item">
            <a class="nav-link" href="../others/report.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Reportes</span>
            </a>
          </li>'?>

          <li class="nav-item">
            <a class="nav-link" href="../others/acount.php">
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
                  <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Bienes 
                    Mobiliarios</h1>
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

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <?php if($_SESSION['rol'] == 'admin') echo '<div class="card-header py-3">
                <button class="btn-crud btn-secondary btn-icon-split" id="agregar">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                  </span>
                  <span class="text text-white">Agregar Bien</span>
                </button>
                <button class="btn-crud btn-secondary btn-icon-split" id="CambiarCustodio">
                  <span class="icon text-white-50">
                  <i class="fas fa-exchange-alt"></i>
                  </span>
                  <span class="text text-white">Cambiar custodio</span>
                </button>
              </div>' ?>
              <div class="card-body bg-darkwhite">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                      <tr>
                        <th>Código UTA</th>
                        <th>Nombre</th>
                        <th>Serie</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Dimensiones</th>
                        <th>Condición</th>
                        <th>Custodio</th>
                        <th>Fecha Ingreso</th>
                        <th>Áreas</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>

                    <tbody>

                    </tbody>

                    
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
<!-- BIENES MOBILIARIOS -->
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

        <form class="forms-sample" id="formAgregar">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para agregar un nuevo bien al
                  sistema:</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAA" id="codigoUTAA" placeholder="Código UTA"
                      required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreA" id="nombreA" placeholder="Nombre" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="modeloA" id="modeloA" placeholder="Modelo" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieA" id="serieA" placeholder="Serie">
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Marca</label>
                    <select class="form-control" id="marcaA" required>
                      <option value="">Seleccione una Marca</option>
                      <?php
                      include_once ("../../Acciones/crudBienes_Mobiliarios.php");
                      $marcas = AccionesBienes_mobiliarios::listarMarcasInsertar();
                      echo ($marcas['dato']);
                      ?>
                    </select>
                  </div>


                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Color</label>
                    <input type="text" class="form-control" name="colorA" id="colorA" placeholder="Color"
                      oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" >
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Material</label>
                    <input type="text" class="form-control" name="materialA" id="materialA" placeholder="Material"
                      oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" >
                  </div>


                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Dimensiones</label>
                    <input type="text" class="form-control" name="dimensionesA" id="dimensionesA"
                      placeholder="Dimensiones" >
                  </div>
                </div>


                <div class="form-row">

                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Condición</label>
                    <select class="form-control" id="condicionA" >
                      <option value="">Seleccione una condición</option>
                      <option value="Buen estado">Buen estado</option>
                      <option value="Mal Estado">Mal Estado</option>
                    </select>
                  </div>

                  
                  
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Custodio</label>
                    <select class="form-control" id="custodioA" required>
                      <option value="">Seleccione un custodio</option>
                      <?php
                      include_once ("../../Acciones/crudBienes_Mobiliarios.php");
                      $usuarios = AccionesBienes_mobiliarios::listarUsuariosInsertar();
                      echo ($usuarios['dato']);
                      ?>
                    </select>
                  </div>




                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Areas</label>
                    <select class="form-control" id="areaA" required>
                      <option value="">Seleccione una área</option>
                      <?php
                      $areas = AccionesBienes_mobiliarios::listarAreasInsertar();
                      echo ($areas['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicacionA" required>
                      <option value="">Seleccione una Ubicación</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Agregar Bien ">
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
        <form class="forms-sample" id="formEliminar">
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
  <div class="modal fade" id="modalCrudEditar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
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
        <form class="forms-sample" id="formEditar">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar la información del
                  bien seleccionado:</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAE" id="codigoUTAE" placeholder="Código UTA"
                      required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreE" id="nombreE" placeholder="Nombre" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="modeloE" id="modeloE" placeholder="Modelo" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieE" id="serieE" placeholder="Serie"
                      oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Marca</label>
                    <select class="form-control" id="marcaE" required>
                      <?php
                      include_once ("../../Acciones/crudBienes_Mobiliarios.php");
                      $marcas = AccionesBienes_mobiliarios::listarMarcasInsertar();
                      echo ($marcas['dato']);
                      ?>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Color</label>
                    <input type="text" class="form-control" name="colorE" id="colorE" placeholder="Color"
                      oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreC" class="text-bold">Material</label>
                    <input type="text" class="form-control" name="materialE" id="materialE" placeholder="Material"
                      oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoUTAC" class="text-bold">Dimensiones</label>
                    <input type="text" class="form-control" name="dimensionesE" id="dimensionesE"
                      placeholder="Dimensiones" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Condición</label>
                    <select class="form-control" id="condicionE" >
                      <option value="">Seleccione una condición</option>
                      <option value="Buen estado">Buen estado</option>
                      <option value="Mal Estado">Mal Estado</option>
                    </select>
                  </div>

                  
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Custodio</label>
                    <select class="form-control" id="custodioE" required>
                      <?php
                      include_once ("../../Acciones/crudBienes_Mobiliarios.php");
                      $custodio = AccionesBienes_mobiliarios::listarUsuariosInsertar();
                      echo ($custodio['dato']);
                      ?>
                    </select>
                  </div>


                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="facultad" class="text-bold">Areas</label>
                    <select class="form-control" id="areaE" required>
                      <?php
                      $areas = AccionesBienes_mobiliarios::listarAreasInsertar();
                      echo ($areas['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicación" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicacionE" required>
                      
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Bien">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade modal-crud" id="modalCambiarCustodio" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Cambiar Custodio</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="formCambiarCustodio">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para realizar el cambio de
                  custodio agregar</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="custodioOrigen" class="text-bold">Custodio de origen</label>
                    <select class="form-control" id="custodioOrigen" required>
                      <option value="">Custodio actual</option>
                      <?php
                      $usuarios = AccionesBienes_mobiliarios::listarUsuariosOrigen();
                      echo ($usuarios['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="custodioDestino" class="text-bold">Custodio de destino</label>
                    <select class="form-control" id="custodioDestino" required>
                      <option value="">Custodio destino</option>
                    </select>
                  </div>
                </div>
                <div class="form-group text-center">
                  <label for="bienesInformaticos" class="text-bold">Bienes Mobiliarios</label>
                  <div id="bienesInformaticos">
                    <!-- Aquí se cargarán los bienes informáticos -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold agregarBien" value="Aceptar">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#areaA').change(function () {
        var areaId = $(this).val();
        if (areaId) {
          $.ajax({
            url: "../../Acciones/CargarUbicaciones.php",
            type: "GET",
            data: { area_id: areaId },
            success: function (response) {
              try {
                var ubicaciones = typeof response === 'string' ? JSON.parse(response) : response;
                console.log("Respuesta parseada: ", ubicaciones);

                if (ubicaciones.codigo === 0) {
                  $('#ubicacionA').empty();
                  $('#ubicacionA').append('<option value="">Seleccione una Ubicación</option>');
                  ubicaciones.dato.forEach(function (ubicacion) {
                    $('#ubicacionA').append('<option value="' + ubicacion.id + '">' + ubicacion.nombre + '</option>');
                  });
                } else {
                  console.error("Error en la respuesta del servidor:", ubicaciones.mensaje);
                }
              } catch (error) {
                console.error("Error al parsear la respuesta JSON:", error);
              }
            },
            error: function (error) {
              console.error("Error en la solicitud AJAX:", error);
            }
          });
        } else {
          $('#ubicacionA').empty();
          $('#ubicacionA').append('<option value="">Seleccione una Ubicación</option>');
        }
      });

      $('#areaE').change(function () {
        var areaId = $(this).val();
        if (areaId) {
          $.ajax({
            url: "../../Acciones/CargarUbicaciones.php",
            type: "GET",
            data: { area_id: areaId },
            success: function (response) {
              try {
                var ubicaciones = typeof response === 'string' ? JSON.parse(response) : response;
                console.log("Respuesta parseada: ", ubicaciones);

                if (ubicaciones.codigo === 0) {
                  $('#ubicacionE').empty();
                  $('#ubicacionE').append('<option value="">Seleccione una Ubicación</option>');
                  ubicaciones.dato.forEach(function (ubicacion) {
                    $('#ubicacionE').append('<option value="' + ubicacion.id + '">' + ubicacion.nombre + '</option>');
                  });
                } else {
                  console.error("Error en la respuesta del servidor:", ubicaciones.mensaje);
                }
              } catch (error) {
                console.error("Error al parsear la respuesta JSON:", error);
              }
            },
            error: function (error) {
              console.error("Error en la solicitud AJAX:", error);
            }
          });
        } else {
          $('#ubicacionE').empty();
          $('#ubicacionE').append('<option value="">Seleccione una Ubicación</option>');
        }
      });
    });
  </script>

<!-- Custodio -->
<script>
    $(document).ready(function () {
      $('#custodioOrigen').change(function () {
        var usuario_id = $(this).val();
        var op = 2;
        if (usuario_id) {
          $.ajax({
            url: "../../Acciones/AccionesExtrasBm.php",
            type: "GET",
            data: {
              usuario_id: usuario_id,
              op: op
            },
            success: function (response) {
              try {
                var usuariosDestino = typeof response === 'string' ? JSON.parse(response) : response;
                console.log("Respuesta parseada: ", usuariosDestino);

                if (usuariosDestino.codigo === 0) {
                  $('#custodioDestino').empty();
                  $('#custodioDestino').append('<option value="">Custodio destino</option>');
                  usuariosDestino.dato.forEach(function (usuariodestino) {
                    $('#custodioDestino').append('<option value="' + usuariodestino.id + '">' + usuariodestino.nombre + ' ' + usuariodestino.apellido + '</option>');
                  });
                } else {
                  console.error("Error en la respuesta del servidor:", usuariosDestino.mensaje);

                }
              } catch (error) {
                console.error("Error al parsear la respuesta JSON:", error);

              }
            },
            error: function (error) {
              console.error("Error en la solicitud AJAX:", error);

            }
          });
        } else {
          $('#custodioDestino').empty();
          $('#custodioDestino').append('<option value="">Custodio Destino</option>');
        }
      });

      $('#custodioOrigen').change(function () {
        var custodioId = $(this).val();
        var op = 3;
        if (custodioId) {
          $.ajax({
            url: "../../Acciones/AccionesExtrasBm.php",
            type: "GET",
            data: {
              custodio_id: custodioId,
              op: op
            },
            success: function (response) {
              try {
                var bienes = typeof response === 'string' ? JSON.parse(response) : response;
                if (bienes.codigo === 0) {
                  $('#bienesInformaticos').empty();
                  bienes.dato.forEach(function (bien) {
                    $('#bienesInformaticos').append('<div><input type="checkbox" name="bienes" value="' + bien.id + '"> Nombre: ' + bien.nombre + ' Modelo: ' + bien.modelo + '</div>');
                  });
                } else {
                  console.error("Error en la respuesta del servidor:", bienes.mensaje);
                }
              } catch (error) {
                console.error("Error al parsear la respuesta JSON:", error);
              }
            },
            error: function (error) {
              console.error("Error en la solicitud AJAX:", error);
            }
          });
        } else {
          $('#bienesInformaticos').empty();
        }
      });

      // Otras funciones y cambios de eventos

  $("#formCambiarCustodio").submit(function (e) {
    /* e.preventDefault(); */

    var seleccionados = [];
    $('#bienesInformaticos input[type="checkbox"]:checked').each(function () {
      seleccionados.push($(this).val());
    });

    var custodioDestino = $('#custodioDestino').val();

    if (seleccionados.length > 0 && custodioDestino) {
      $.ajax({
          url: "../../Acciones/AccionesExtrasBm.php",
          type: "PUT",
          data: JSON.stringify({
          bienes: seleccionados,
          custodioDestino: custodioDestino
          }),
            contentType: "application/json",
            success: function (response) {
            try {
              var result = typeof response === 'string' ? JSON.parse(response) : response;
              if (result.codigo === 0) {
                  $("#modalCambiarCustodio").modal('hide');
                  cargarTabla();  // Asume que cargarTabla() recarga la tabla principal de bienes
                } else {
                }
              } catch (error) {
                console.error("Error al parsear la respuesta JSON:", error);
              }
            },
            error: function (error) {
              console.error("Error en la solicitud AJAX", error);
            }
          });
        } else {
        }
      });
    });

  </script>
  
 <!-- SCRIPT  DE FUNCIONES --> 
 <script>
  $(document).ready(function () {

    $("#CambiarCustodio").click(function () {
        $("#modalCambiarCustodio").modal('show');
      });

      $("#formAgregar").submit(function (e) {
        /* e.preventDefault(); */
        codigo_uta = $("#codigoUTAA").val();
        nombre = $("#nombreA").val();
        serie = $("#serieA").val();
        id_marca = $("#marcaA").val();
        modelo = $("#modeloA").val();
        color = $("#colorA").val();
        material = $("#materialA").val();
        dimensiones = $("#dimensionesA").val();
        condicion = $("#condicionA").val();
        custodio = $("#custodioA").val();
        id_area_per = $("#areaA").val();
        id_ubi_per = $("#ubicacionA").val();
        $.ajax({
          url: "../../Acciones/RestBienes_Mobiliarios.php",
          type: "POST",
          data: JSON.stringify({
            codigo_uta: codigo_uta,
            nombre: nombre,
            serie: serie,
            id_marca: id_marca,
            modelo: modelo,
            color: color,
            material: material,
            dimensiones: dimensiones,
            condicion: condicion,
            custodio: custodio,
            id_area_per: id_area_per,
            id_ubi_per: id_ubi_per
          }),
          contentType: "application/json",
          cache: false,
          error: function (error) {
            console.error("Error en la solicitud AJAX", error);
          },
          complete: function () {
            $("#modalCrudAgregar").modal('hide');
            $("#codigoUTAA").val("");
            $("#nombreA").val("");
            $("#serieA").val("");
            $("#marcaA").val("");
            $("#modeloA").val("");
            $("#colorA").val("");
            $("#materialA").val("");
            $("#dimensionesA").val("");
            $("#condicionA").val("");
            $("#custodioA").val("");
            $("#areaA").val("");
            $("#ubicacionA").val("");
            cargarTabla();
          }
        });
      });
    });

    function cargarTabla() {
        fetch('../../Acciones/RestBienes_Mobiliarios.php', {
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
                  <td>${respuesta.codigo_uta}</td>
                  <td>${respuesta.nombre}</td>
                  <td>${respuesta.serie}</td>
                  <td>${respuesta.nombre_marca}</td>
                  <td>${respuesta.modelo}</td>
                  <td>${respuesta.color}</td>
                  <td>${respuesta.material}</td>
                  <td>${respuesta.dimensiones}</td>
                  <td>${respuesta.condicion}</td>
                  <td>${respuesta.nombre_custodio} ${respuesta.apellido_custodio}</td>
                  <td>${respuesta.fecha_ingreso}</td>
                  <td>${respuesta.nombre_area}</td>
                  <td>${respuesta.nombre_ubicacion}</td>
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
       
                  <input type="hidden" class="id_marca" value="${respuesta.id_marca}">
                  <input type="hidden" class="id_area_per" value="${respuesta.id_area_per}">
                  <input type="hidden" class="id_ubi_per" value="${respuesta.id_ubi_per}">
                  <input type="hidden" class="custodio_actual" value="${respuesta.custodio_actual}">
              `;
                tr.dataset.area = respuesta.nombre_area;
                tr.dataset.bloque = respuesta.nombre_bloque;
                tbody.appendChild(tr);
              });
            } else {
              const tr = document.createElement('tr');
              const td = document.createElement('td');
              td.textContent = 'No se encontraron facultades.';
              td.setAttribute('colspan', '15');
              tr.appendChild(td);
              tbody.appendChild(tr);
            }

            const dataTable = $('#dataTable').DataTable({
              scrollX: true,  // Permite el desplazamiento horizontal
              fixedHeader: {
                  header: true,  // Fija la cabecera
                  footer: true   // Fija el pie de página
              },
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
              dom: '<"top"f>rt<"bottom"ip><"clear">',
              initComplete: function () {
                // Insertar el campo de búsqueda por bloque antes del campo de búsqueda general
                $('#dataTable_filter').append('<label style="margin-left: 10px;">Buscar por marcas:<input type="text" id="searchMarcas" class="form-control input-sm" placeholder="Buscar por marcas" style="display: inline-block; width: auto; height: 30px; padding: 2px 5px; margin-left: 5px;"></label>');
                // Agregar evento de búsqueda al campo de búsqueda por bloque
                $('#searchMarcas').on('keyup', function () {
                  dataTable.column(3).search(this.value).draw(); // 2 es el índice de la columna de facultades/bloques
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
            var rolUser = $('#rolUser').val();
            var table = $('#dataTable').DataTable();
            if (rolUser === 'estudiante') {
              const columnCount = table.columns().nodes().length;
              table.column(columnCount - 1).visible(false);
            }

            // Agregar event listeners a los botones después de cargar la tabla
            addEventListeners();
          })
          .catch(error => {
            console.error('Error:', error);
            const tbody = document.querySelector('#dataTable tbody');
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.textContent = 'Error al cargar los datos.';
            td.setAttribute('colspan', '15');
            tr.appendChild(td);
            tbody.appendChild(tr);
          });
      }

    function addEventListeners() {
      id = "";
      $(document).on('click', '.editar', function () {
        id = $(this).data("id");
        fila = $(this).closest("tr");
        codigo_uta = fila.find('td:eq(0)').text();
        nombre = fila.find('td:eq(1)').text();
        serie = fila.find('td:eq(2)').text();
        modelo = fila.find('td:eq(4)').text();
        color = fila.find('td:eq(5)').text();
        material = fila.find('td:eq(6)').text();
        dimensiones = fila.find('td:eq(7)').text();
        condicion = fila.find('td:eq(8)').text();
        custodio = fila.find('td:eq(9)').text();
        id_marca = fila.find('.id_marca').val();
        id_area_per = fila.find('.id_area_per').val();
        id_ubi_per = fila.find('.id_ubi_per').val();
        custodio_actual = fila.find('.custodio_actual').val();
        

        $("#codigoUTAE").val(codigo_uta);
        $("#nombreE").val(nombre);
        $("#modeloE").val(modelo);
        $("#marcaE").val(id_marca);
        $("#areaE").val(id_area_per);
        $("#serieE").val(serie);
        $("#colorE").val(color);
        $("#materialE").val(material);
        $("#dimensionesE").val(dimensiones);
        $("#condicionE").val(condicion);
        $("#custodioE").val(custodio_actual);
        $("#ubicacionE").val(id_ubi_per);
          if (id_area_per) {
            $.ajax({
              url: "../../Acciones/CargarUbicaciones.php",
              type: "GET",
              data: { area_id: id_area_per },
              success: function (response) {
                var ubicaciones = typeof response === 'string' ? JSON.parse(response) : response;
                if (ubicaciones.codigo === 0) {
                  $('#ubicacionE').empty();
                  $('#ubicacionE').append('<option value="">Seleccione una Ubicación</option>');
                  ubicaciones.dato.forEach(function (ubicacion) {
                    $('#ubicacionE').append('<option value="' + ubicacion.id + '">' + ubicacion.nombre + '</option>');
                  });
                  $("#ubicacionE").val(id_ubi_per);
                } else {
                }
              },
              error: function () {
              }
            });
          } else {
            $('#ubicacionE').empty();
            $('#ubicacionE').append('<option value="">Seleccione una Ubicación</option>');
          }
        $("#modalCrudEditar").modal('show');
      });

      $("#formEditar").submit(function (e) {
     /*e.preventDefault(); */
        id;
        codigo_uta = $("#codigoUTAE").val();
        nombre = $("#nombreE").val();
        modelo = $("#modeloE").val();
        id_marca = $("#marcaE").val();
        serie = $("#serieE").val();
        color = $("#colorE").val();
        material = $("#materialE").val();
        dimensiones = $("#dimensionesE").val();
        condicion = $("#condicionE").val();
        custodio = $("#custodioE").val();
        id_area_per = $("#areaE").val();
        id_ubi_per = $("#ubicacionE").val();

        $.ajax({
          url: "../../Acciones/RestBienes_Mobiliarios.php",
          type: "PUT",
          data: JSON.stringify({
            id: id,
            codigo_uta: codigo_uta,
            nombre: nombre,
            modelo: modelo,
            id_marca: id_marca,
            serie: serie,
            color: color,
            material: material,
            dimensiones: dimensiones,
            condicion: condicion,
            custodio: custodio,
            id_area_per: id_area_per,
            id_ubi_per: id_ubi_per
          }),
          contentType: "application/json",
          error: function (error) {
            console.error("Error en la solicitud AJAX", error);
          },
          complete: function () {
            $("#modalCrudEditar").modal('hide');
            cargarTabla();
          }
        });
      });

      $(document).on('click', '.eliminar', function () {
        id = $(this).data("id");
        $("#modalCrudEliminar").modal('show');
      });

      $("#formEliminar").submit(function (e) {
        /* e.preventDefault(); */

        $.ajax({
          url: "../../Acciones/RestBienes_Mobiliarios.php",
          type: "DELETE",
          data: JSON.stringify({
            id: id
          }),
          contentType: "application/json",
          error: function (error) {
            console.error("Error en la solicitud AJAX", error);
          },
          complete: function () {
            $("#modalCrudEliminar").modal('hide');
            cargarTabla();
          }
        });
      });
    }

    document.addEventListener('DOMContentLoaded', function () {
      cargarTabla();
    });

  </script>


  <!-- plugins:js -->
  <script src="../../resources/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../resources/vendors/chart.js/Chart.min.js"></script>
  <script src="../../resources/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../../resources/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
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
  <script src="../../resources/vendors/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../resources/js/datatables-demo.js"></script>
  
</body>

</html>