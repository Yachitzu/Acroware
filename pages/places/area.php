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
  <title>Gestión - Áreas</title>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <li class="nav-item"> <a class="nav-link" href="faculty.php">Facultades</a></li>
                <li class="nav-item"> <a class="nav-link" href="block.php">Bloques</a></li>
                <li class="nav-item"> <a class="nav-link" href="area.php">Áreas</a></li>
                <li class="nav-item"> <a class="nav-link" href="location.php">Ubicaciones</a></li>
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
                  <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Áreas</h1>
                  <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white" href="../../index.php">Inicio</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Gestor de Áreas</p>
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
                  <span class="text text-white">Agregar Área</span>
                </button>
              </div>
              <div class="card-body bg-darkwhite">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead>
                      <tr>

                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Facultad Pertenece</th>
                        <th>Bloque Pertenece</th>
                        <th>Piso</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                      <tr>

                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Facultad Pertenece</th>
                        <th>Bloque Pertenece</th>
                        <th>Piso</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
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
 <div class="modal fade modal-crud" id="modalCrudAgregar" tabindex="-1" role="dialog"
    aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Agregar Área</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="formAgregar">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para agregar una nueva Área de un
                  Bloque al sistema:</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="Name" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" id="nombreA" placeholder="Nombre" required>
                  </div>

                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="bloque" class="text-bold">Bloque Pertenece</label>
                    <select class="form-control" id="bloqueA" required>
                      <option value="">Seleccione un Bloque</option>
                      <?php
                      include_once ("../../Acciones/crudAreas.php");
                      $bloques = AccionesAreas::listarBloquesInsertar();
                      echo ($bloques['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="piso" class="text-bold">Piso Pertenece</label>
                    <select class="form-control" id="pisoA" required>
                      <option value="">Seleccione un Piso</option>
                      
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="Name" class="text-bold">Descripción</label>
                    <textarea class="form-control" id="descripcionA" placeholder="Descripción"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Agregar Área ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalCrudEliminar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Eliminar Área </h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="formEliminar">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">¿Está seguro de que desea eliminar el Área?</p>
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
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Eliminar Área ">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalCrudEditar" tabindex="-1" role="dialog" aria-labelledby="modal-register-label"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="modal-register-label">Editar Área</h3>
          <p class="modal">Ingrese los datos del Usuario:</p>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times" class="element-white"></i>
          </button>
        </div>
        <form class="forms-sample" id="formEditar">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar la información del
                  Área seleccionada:</p>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="Name" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" id="nombreE" placeholder="Nombre" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="bloque" class="text-bold">Bloque Pertenece</label>
                    <select class="form-control" id="bloqueE" required>
                      <?php
                      $bloques = AccionesAreas::listarBloquesInsertar();
                      echo ($bloques['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="piso" class="text-bold">Piso Pertenece</label>
                    <select class="form-control" id="pisoE" required>
                      
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="Name" class="text-bold">Descripción</label>
                    <textarea class="form-control" id="descripcionE" placeholder="Descripción"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold" value=" Editar Área ">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('bloqueA').addEventListener('change', function () {
        var selectedBlock = this.options[this.selectedIndex];
        var maxPiso = parseInt(selectedBlock.getAttribute('data-max-piso'));
        var pisoSelect = document.getElementById('pisoA');

        // Limpiar las opciones actuales del select de pisos
        while (pisoSelect.options.length > 0) {
            pisoSelect.remove(0);
        }

        // Función para obtener el nombre del piso según el número
        function getPisoName(piso) {
            if (piso === 0) return 'Planta Baja';
            if (piso === 1) return 'Primer Piso';
            if (piso === 2) return 'Segundo Piso';
            if (piso === 3) return 'Tercer Piso';
            if (piso === 4) return 'Cuarto Piso';
            if (piso === 5) return 'Quinto Piso';
            if (piso === 6) return 'Sexto Piso';
            return 'Piso ' + piso;
        }

        // Agregar nuevas opciones basadas en el max_piso
        for (var i = 0; i <= maxPiso; i++) {
            var newOption = document.createElement('option');
            newOption.value = getPisoName(i);
            newOption.text = getPisoName(i);
            pisoSelect.add(newOption);
        }
    });
</script>

  <script>
    $(document).ready(function () {
      $("#formAgregar").submit(function (e) {
        e.preventDefault();
        nombre = $("#nombreA").val();
        descripcion = $("#descripcionA").val();
        id_bloque_per = $("#bloqueA").val();
        piso = $("#pisoA").val();
        $.ajax({
          url: "../../Acciones/RestAreas.php",
          type: "POST",
          data: JSON.stringify({
            nombre: nombre,
            descripcion: descripcion,
            id_bloque_per: id_bloque_per,
            piso: piso,
          }),
          contentType: "application/json",
          cache: false,
          error: function (error) {
            console.error("Error en la solicitud AJAX", error);
          },
          complete: function () {
            $("#modalCrudAgregar").modal('hide');
            $("#nombreA").val("");
            $("#descripcionA").val("");
            $("#bloqueA").val("");
            $("#pisoA").val("");
            var pisoSelect = document.getElementById('pisoA');
                    while (pisoSelect.options.length > 0) {
                        pisoSelect.remove(0);
                    }
                    var defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.text = "Seleccione un Piso";
                    pisoSelect.add(defaultOption);
            cargarTabla();
          }
        });
      });
    });
    function cargarTabla() {
      fetch('../../Acciones/RestAreas.php', {
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
            tbody.innerHTML = data.dato;
          } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.textContent = 'No se encontraron áreas.';
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
            initComplete: function() {
              // Insertar el campo de búsqueda por bloque antes del campo de búsqueda general
                $('#dataTable_filter').append('<label style="margin-left: 10px;">Buscar por Bloques:<input type="text" id="searchBloques" class="form-control input-sm" placeholder="Buscar por Bloques" style="display: inline-block; width: auto; margin-left: 5px;"></label>');
                
                // Agregar evento de búsqueda al campo de búsqueda por bloque
                $('#searchBloques').on('keyup', function() {
                  dataTable.column(3).search(this.value).draw(); // 2 es el índice de la columna de facultades/bloques
                });
             }
          });
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
      id = "";
      $(".editar").click(function () {
        id = $(this).data("id");
        const fila = $(this).closest("tr");
        const nombre = fila.find('td:eq(0)').text();
        const descripcion = fila.find('td:eq(1)').text();
        const id_bloque_per = fila.find('.id_bloque_per').val();
        const piso = fila.find('td:eq(4)').text();
        
        $("#nombreE").val(nombre);
        $("#descripcionE").val(descripcion);
        $("#bloqueE").val(id_bloque_per);

        // Obtener el bloque seleccionado
        const selectedBlock = document.getElementById('bloqueE').querySelector(`option[value="${id_bloque_per}"]`);
        const maxPiso = parseInt(selectedBlock.getAttribute('data-max-piso'));

        // Llamar a la función para actualizar los pisos
        updatePisoSelect(maxPiso, piso);

        $("#modalCrudEditar").modal('show');
    });

    document.getElementById('bloqueE').addEventListener('change', function () {
        const selectedBlock = this.options[this.selectedIndex];
        const maxPiso = parseInt(selectedBlock.getAttribute('data-max-piso'));
        updatePisoSelect(maxPiso, "");
    });

    function updatePisoSelect(maxPiso, selectedPiso) {
        const pisoSelect = document.getElementById('pisoE');
        
        // Limpiar y agregar opciones al select de pisos
        while (pisoSelect.options.length > 0) {
            pisoSelect.remove(0);
        }

        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.text = "Seleccione un Piso";
        pisoSelect.add(defaultOption);

        function getPisoName(piso) {
            if (piso === 0) return 'Planta Baja';
            if (piso === 1) return 'Primer Piso';
            if (piso === 2) return 'Segundo Piso';
            if (piso === 3) return 'Tercer Piso';
            if (piso === 4) return 'Cuarto Piso';
            if (piso === 5) return 'Quinto Piso';
            if (piso === 6) return 'Sexto Piso';
            return 'Piso ' + piso;
        }

        for (let i = 0; i <= maxPiso; i++) {
            const newOption = document.createElement('option');
            newOption.value = getPisoName(i);
            newOption.text = getPisoName(i);
            if (newOption.text === selectedPiso) {
                newOption.selected = true;
            }
            pisoSelect.add(newOption);
        }
    }

      $("#formEditar").submit(function (e) {
        e.preventDefault();
        id;
        nombre = $("#nombreE").val();
        descripcion = $("#descripcionE").val();
        id_bloque_per = $("#bloqueE").val();
        piso = $("#pisoE").val();
        $.ajax({
          url: "../../Acciones/RestAreas.php",
          type: "PUT",
          data: JSON.stringify({
            id: id,
            nombre: nombre,
            descripcion: descripcion,
            piso: piso,
            id_bloque_per: id_bloque_per,
          }), contentType: "application/json",
          cache: false,
          error: function (error) {
            console.error("Error en la solicitud AJAX", error);
          },
          complete: function () {
            $("#modalCrudEditar").modal('hide');
            cargarTabla();
          }
        });
      });

      $(".eliminar").click(function () {
        id = $(this).data("id");
        $("#modalCrudEliminar").modal('show');
      });

      $("#formEliminar").submit(function (e) {
        e.preventDefault();
        id;
        opcion = 9;
        $.ajax({
          url: "../../Acciones/RestAreas.php",
          type: "DELETE",
          data: JSON.stringify({
            id: id
          }), contentType: "application/json",
          error: function (jqXHR) {
            var response = jqXHR.responseJSON;
            var message = "Esta área esta siendo usada en ubicaciones.";
            if (response && response.message) {
                message = response.message;
            }
            Swal.fire({
                icon: "info",
                text: message,
                confirmButtonText: "Cerrar",
                confirmButtonColor: "#bd3503", 
                iconColor: "#bd3503"
            });
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
</body>

</html>