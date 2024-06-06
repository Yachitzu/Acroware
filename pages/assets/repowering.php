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
  <title>Bienes Informáticos - Repotenciación</title>
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
            <a class="nav-link" href="../others/report.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Reportes</span>
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
                  <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Repotenciación</h1>
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

            <!-- DataTable -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <button class="btn-crud btn-secondary btn-icon-split" id="agregar">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                  </span>
                  <span class="text text-white">Agregar Reponteciación</span>
                </button>
              </div>
              <div class="card-body bg-darkwhite">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            
                            <th>Codigo UTA</th>
                            <th>Componente</th>
                            <th>Nombre</th>
                            <th>Serie</th>
                            <th>Detalle</th>
                            <th>Fecha Repotenciación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="repoTableBody">
                    </tbody>
                    <tfoot>
                        <tr>
                            
                            <th>Codigo UTA</th>
                            <th>Componente</th>
                            <th>Nombre</th>
                            <th>Serie</th>
                            <th>Detalle</th>
                            <th>Fecha Repotenciación</th>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <h3 class="modal-title text-white" id="modal-register-label">Agregar Repotenciación</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="agregarRepoForm" method="post">
          <div class="modal-body">
            <div class="grid-margin-modal">
                <div class="card-body">
                    <p class="card-description">Por favor, complete los siguientes campos para agregar un nuevo bien al
                    sistema:</p>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="codigoC" class="text-bold">Codigo UTA</label>
                            <input type="text" class="form-control" name="codigoC" id="codigoC" placeholder="Código UTA" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombreC" class="text-bold">Nombre</label>
                            <input type="text" class="form-control" name="nombreC" id="nombreC" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="serieC" class="text-bold">Serie</label>
                            <input type="text" class="form-control" name="serieC" id="serieC" placeholder="Serie" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="componente" class="text-bold">Componente</label>
                            <select class="form-control" id="ComponentesBox" required>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="detalleC" class="text-bold">Descripción</label>
                            <textarea class="form-control" id="detalleC" placeholder="Descripción"></textarea>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold " data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Agregar Repotenciación ">
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
          <h3 class="modal-title text-white" id="modal-register-label">Eliminar Repotenciación </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="eliminarRepotenciacionForm">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">¿Está seguro de que desea eliminar la Repotenciación?</p>
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
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Eliminar Repotenciación ">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Modal-->
  <div class="modal fade" id="modalCrud" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Editar Repotenciación</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="editarRepotenciacionForm">
          <div class="modal-body">
            <div class="grid-margin-modal">
                <div class="card-body">
                    <p class="card-description">Por favor, complete los siguientes campos para editar la información de la Repotenciación seleccionada:</p>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="codigoE" class="text-bold">Codigo UTA</label>
                            <input type="text" class="form-control" name="codigoE" id="codigoE" placeholder="Código UTA" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombreE" class="text-bold">Nombre</label>
                            <input type="text" class="form-control" name="nombreE" id="nombreE" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="serieE" class="text-bold">Serie</label>
                            <input type="text" class="form-control" name="serieE" id="serieE" placeholder="Serie" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="componenteE" class="text-bold">Componente</label>
                            <select class="form-control" id="ComponentesBoxE" required>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="detalleE" class="text-bold">Descripción</label>
                            <textarea class="form-control" id="detalleE" placeholder="Descripción"></textarea>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Repotenciación">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- main script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const url = '../../Acciones/RestComponentes.php?nombres=1';

      // Realiza la petición GET al servicio
      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error('Error de conexión ' + response.statusText);
          }
          return response.json();
        })
        .then(data => {
          // Obtener los elementos select
          const comboBox1 = document.getElementById('ComponentesBox');
          const comboBox2 = document.getElementById('ComponentesBoxE');

          // Vaciar los combobox (en caso de que ya tengan opciones)
          comboBox1.innerHTML = '<option value="">Seleccione una opción</option>';
          comboBox2.innerHTML = '<option value="">Seleccione una opción</option>';

          // Recorrer los datos y agregar cada opción a ambos combobox
          data.forEach(componente => {
            const option1 = document.createElement('option');
            option1.value = componente.id; // Ajusta esto según la estructura de tu JSON
            option1.text = componente.nombre; // Ajusta esto según la estructura de tu JSON
            comboBox1.appendChild(option1);

            const option2 = document.createElement('option');
            option2.value = componente.id; // Ajusta esto según la estructura de tu JSON
            option2.text = componente.nombre; // Ajusta esto según la estructura de tu JSON
            comboBox2.appendChild(option2);
          });
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
      const apiBaseUrl = '../../Acciones/RestRepotenciaciones.php';

      const repoTableBody = document.getElementById('repoTableBody');
      const agregarRepoForm = document.getElementById('agregarRepoForm');
      const editarModal = new bootstrap.Modal(document.getElementById('modalCrud'));
      const eliminarModal = new bootstrap.Modal(document.getElementById('modalCrudEliminar'));

      let repotenciacionAEliminarId = null;
      let componenteId = null;
      let repotenciacionAEditarId = null;

      $('#dataTable').DataTable({
        "processing": false,
        "serverSide": true,
        "ajax": {
          "url": apiBaseUrl,
          "type": "GET",
          "data": function (d) {
            d.start = d.start || 0; // Indice de inicio para la paginación
            d.length = d.length || 10; // Número de registros por página
            d.draw = d.draw || 1; // Número de la solicitud de dibujo
            d.search = d.search || {}; // Objeto de búsqueda
            d.search.value = d.search.value || ""; // Valor de búsqueda
            d.order = d.order || [0, 'asc']; // Orden de las columnas
            return d;
          },
          "dataSrc": function (json) {
            // Devuelve los datos de la respuesta JSON
            return json.data;
          },
          "error": function (xhr, error, thrown) {
            console.log('Error:', error);
          }
        },
        "columns": [
          { "data": "codigo_adi_uta" },
          { "data": "componente" },
          { "data": "nombre" },
          { "data": "serie" },
          { "data": "detalle_repotenciacion" },
          { "data": "fecha_repotenciacion" },
          {
            "data": null,
            "defaultContent": "",
            "orderable": false,
            "searchable": false,
            "render": function (data, type, row) {
              return `
                          <center>          
                              <button class="btn btn-warning btn-circle element-white editar" id="editar" onclick="showEditarModal(${row.id},${row.id_componente})">
                                  <i class="fas fa-edit"></i>
                              </button>
                              <button class="btn btn-danger btn-circle eliminar" id="eliminar" onclick="showEliminarModal(${row.id},${row.id_componente})">
                                  <i class="fas fa-trash"></i>
                              </button>
                          </center>
                      `;
            }
          }
        ],
        "searching": true, // Habilita la búsqueda
        "lengthChange": true, // Habilita el cambio de longitud
        "lengthMenu": [10, 25, 50, 100], // Opciones de longitud de página
        "paging": true, // Habilita la paginación
        "info": true, // Habilita la información de la tabla
        "ordering": true, // Habilita la ordenación
        "order": [[0, 'asc']], // Columna inicial para ordenar
        "language": {
          // Personaliza los textos, por ejemplo:
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "zeroRecords": "No se encontraron registros",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 a 0 de 0 registros",
          "infoFiltered": "(filtrado de _MAX_ registros totales)",
          "search": "Buscar:",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          }
        }
      });

      async function fetchRepotenciaciones() {
        try {
          const response = await fetch(apiBaseUrl, {
            headers: {
              'Content-Type': 'application/json'
            }
          });
          const responseData = await response.json();
          const data = responseData.data;
          console.log('Datos recibidos del servidor:', data)

          $('#dataTable').DataTable().clear().draw();

          // Agregar filas a la tabla
          data.forEach(repotenciacion => {
            $('#dataTable').DataTable().row.add({

              "codigo_adi_uta": repotenciacion.codigo_adi_uta,
              "componente": repotenciacion.componente,
              "nombre": repotenciacion.nombre,
              "serie": repotenciacion.serie,
              "detalle_repotenciacion": repotenciacion.detalle_repotenciacion,
              "fecha_repotenciacion": repotenciacion.fecha_repotenciacion,
              "id_componente": repotenciacion.id_componente,
              "id": repotenciacion.id


            }).draw();
          });
        } catch (error) {
          console.error('Error fetching repotenciaciones:', error);
        }
      }

      agregarRepoForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        
        const codigo = document.getElementById('codigoC').value;
        const nombre = document.getElementById('nombreC').value;
        const serie = document.getElementById('serieC').value;
        const componente = document.getElementById('ComponentesBox').value;
        const detalle = document.getElementById('detalleC').value;

        try {
          const response = await fetch(apiBaseUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ codigo, nombre, serie, componente, detalle })
          });

          if (response.ok) {
            // Si la solicitud es exitosa, recarga la lista de repotenciaciones
            fetchRepotenciaciones();
            // Limpia los campos del formulario
            agregarRepoForm.reset();
            // Cierra el modal
            $('#modalCrudAgregar').modal('hide');
          } else {
            console.error('Error al agregar repotenciacion:', response.statusText);
          }
        } catch (error) {
          console.error('Error al agregar repotenciacion:', error);
        }
      });



      document.getElementById('editarRepotenciacionForm').addEventListener('submit', async function (event) {
        event.preventDefault();
        // Obtener los valores actualizados del formulario
        const id = repotenciacionAEditarId;
        const codigo = document.getElementById('codigoE').value;
        const nombre = document.getElementById('nombreE').value;
        const serie = document.getElementById('serieE').value;
        const componente = document.getElementById('ComponentesBoxE').value;
        const detalle = document.getElementById('detalleE').value;

        try {
          // Enviar la solicitud de edición al servidor
          const response = await fetch(apiBaseUrl + `?id=${id}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, codigo, nombre, serie, componente, detalle })
          });

          if (response.ok) {
            const result = await response.json();
            if (result.success) {
              // Si la solicitud es exitosa, recarga la lista de repotenciaciones
              await fetchRepotenciaciones();
              // Cierra el modal de edición
              editarModal.hide();
            } else {
              console.error('Error al editar repotenciacion:', result.message);
            }
          } else {
            console.error('Error al editar repotenciacion:', response.statusText);
          }
        } catch (error) {
          console.error('Error al editar repotenciacion:', error);
        }
      });


      const eliminarRepotenciacionForm = document.getElementById('eliminarRepotenciacionForm');

      eliminarRepotenciacionForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        try {
          const id = repotenciacionAEliminarId;
          const componente = componenteId;

          if (!id) {
            console.error('ID de repotenciacion a eliminar no está definido.');
            return;
          }

          const response = await fetch(`${apiBaseUrl}?id=${id}&componente=${componente}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json'
            }
          });

          if (response.ok) {
            const responseData = await response.json();
            if (responseData.success) {
              // Si la solicitud es exitosa, recarga la lista de repotenciaciones
              await fetchRepotenciaciones();
              // Cierra el modal de eliminación
              eliminarModal.hide();

            } else {
              console.error('Error al eliminar repotenciacion:', responseData.message || response.statusText);
              alert(responseData.message)
            }
          }
        } catch (error) {
          console.error('Error al eliminar repotenciacion:', error);
        }
      });

      window.showEditarModal = async function (id,id_componente) {
        try {
          const response = await fetch(apiBaseUrl + `?id=${id}`);
          if (!response.ok) {
            throw new Error('Error al obtener detalles de la repotenciacion para editar');
          }
          const responseRepotenciacion = await response.json();
          const repotenciacion = responseRepotenciacion.data;
          console.log(repotenciacion)
          // Llenar los campos del formulario con los detalles de la repotenciacion

          document.getElementById('codigoE').value = repotenciacion.codigo_adi_uta;
          document.getElementById('nombreE').value = repotenciacion.nombre;
          document.getElementById('serieE').value = repotenciacion.serie;
          document.getElementById('detalleE').value = repotenciacion.detalle_repotenciacion;
          const selectedComponente = id_componente;
          const componenteEInput = document.getElementById('ComponentesBoxE');

          // Iteramos sobre cada opción en el campo de selección
          for (let i = 0; i < componenteEInput.options.length; i++) {
            // Si el valor de la opción coincide con el valor seleccionado previamente
            if (componenteEInput.options[i].value === selectedComponente) {
              // Marcamos esta opción como seleccionada
              componenteEInput.options[i].selected = true;
              // Salimos del bucle ya que hemos encontrado la opción correcta
              break;
            }
          }
          repotenciacionAEditarId = id;
          // Mostrar el modal de edición
          editarModal.show();
        } catch (error) {
          console.error(error);
        }
      };


      window.showEliminarModal = function (id,id_componente) {
        repotenciacionAEliminarId = id;
        componenteId = id_componente;
        eliminarModal.show()
        console.log('Mostrar modal de eliminación para el ID:', id,' y ',id_componente);
      };

      fetchRepotenciaciones();
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
  <script src="../../resources/js/todolist.js"></script>
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
  <script src="../../resources/vendors/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../resources/js/datatables-demo.js"></script>
</body>

</html>