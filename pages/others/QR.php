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
                                <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase titleMain font-berthold">Código QR</h1>
                                <div class="d-inline-flex mb-lg-5">
                                    <p class="m-0 text-white"><a class="text-white" href="../../index.php">Inicio</a></p>
                                    <p class="m-0 text-white px-2">/</p>
                                    <p class="m-0 text-white">Información QR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid py-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <h2 class="col-md-12 text-center">Editar por medio del Código QR</h2>
                        </div>
                    </div>
                    <div class="card-body bg-darkwhite">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-6 text-center"> 
                                <img src="../../resources/images/logos/OIP.jpg" alt="Código QR" class="img-fluid mb-3">
                                <br>
                                <button type="submit" class="btn btn-primary btn-user font-weight-semi-bold text-white editar" id="editar">
                                    Editar Información
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        <form class="forms-sample" id="formEditarBienes">
          <div class="modal-body">
            <div class="grid-margin-modal">
              <div class="card-body">
                <p class="card-description">Por favor, complete los siguientes campos para editar la información del
                  bien seleccionado:</p>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="codigoUTAE" class="text-bold">Codigo UTA</label>
                    <input type="text" class="form-control" name="codigoUTAE" id="codigoUTAE" placeholder="Código UTA"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6" hidden>
                    <label for="idE" class="text-bold" hidden>ID</label>
                    <input type="text" class="form-control" name="idE" id="idE" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" hidden>

                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreE" class="text-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombreE" id="nombreE" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="serieE" class="text-bold">Serie</label>
                    <input type="text" class="form-control" name="serieE" id="serieE" placeholder="Serie"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="marcaE" class="text-bold">Marca</label>
                    <select class="form-control" id="marcaE" required>
                    <option value="">Seleccione una Marca</option>
                    <?php
                      include_once ("../../Acciones/crudBienes_Informaticos.php");
                      $marcas = AccionesBienes_Informaticos::listarMarcasInsertar();
                      echo ($marcas['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="modeloE" class="text-bold">Modelo</label>
                    <input type="text" class="form-control" name="modeloE" id="modeloE" placeholder="Modelo"
                      required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="areaE" class="text-bold">Áreas</label>
                    <select class="form-control" id="areaE" required>
                    <option value="">Seleccione un Área</option>
                    <?php
                      $areasE = AccionesBienes_Informaticos::listarAreasInsertar();
                      echo ($areasE['dato']);
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ubicacionE" class="text-bold">Ubicación</label>
                    <select class="form-control" id="ubicacionE" required>
                    
                    </select>
                  </div>
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
          <div class="modal-footer">
            <input type="button" class="btn-crud btn-secondary text-white text-bold" data-bs-dismiss="modal"
              aria-label="Close" value="Cancelar" id="cancelButton">
            <input type="submit" class="btn-crud btn-primary text-bold editarBien" id="editarBien" value=" Editar Bien">
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#areaE').change(function() {
        var areaId = $(this).val();
        if (areaId) {
          $.ajax({
            url: "../../Acciones/CargarUbicaciones.php",
            type: "GET",
            data: {
              area_id: areaId
            },
            success: function(response) {
              try {
                var ubicaciones = typeof response === 'string' ? JSON.parse(response) : response;
                console.log("Respuesta parseada: ", ubicaciones);

                if (ubicaciones.codigo === 0) {
                  $('#ubicacionE').empty();
                  $('#ubicacionE').append('<option value="">Seleccione una Ubicación</option>');
                  ubicaciones.dato.forEach(function(ubicacion) {
                    $('#ubicacionE').append('<option value="' + ubicacion.id + '">' + ubicacion.nombre + '</option>');
                  });
                } else {
                  console.error("Error en la respuesta del servidor:", ubicaciones.mensaje);
                }
              } catch (error) {
                console.error("Error al parsear la respuesta JSON:", error);
              }
            },
            error: function(error) {
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
  <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
  $(document).ready(function (){
    $(document).on('click', '.editar', function () {
    let id = $("#idE").val();

    if (id) {
        fetch(`../../Acciones/RestBienes_Informaticos.php?op=GET&id=${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.codigo === 0) {
                    let respuesta = data.datos; // Solo necesitas un registro, ya que esperas un solo bien informático
                    let codigo_uta = respuesta.codigo_uta;
                    let nombre = respuesta.nombre;
                    let modelo = respuesta.modelo;
                    let nombre_marca = respuesta.id_marca;
                    let serie = respuesta.serie;
                    let nombre_area = respuesta.id_area_per;
                    let nombre_ubicacion = respuesta.id_ubi_per;
                    let custodio = respuesta.custodio;

                    $("#codigoUTAE").val(codigo_uta);
                    $("#nombreE").val(nombre);
                    $("#modeloE").val(modelo);
                    $("#marcaE").val(nombre_marca);
                    $("#areaE").val(nombre_area); // Corregido el error en esta línea
                    $("#ubicacionE").val(nombre_ubicacion); // Corregido el error en esta línea
                    $("#serieE").val(serie);
                    $("#usuarioE").val(custodio);
                    if (nombre_area) {
                      $.ajax({
                        url: "../../Acciones/CargarUbicaciones.php",
                        type: "GET",
                        data: {
                          area_id: nombre_area
                        },
                        success: function(response) {
                          var ubicaciones = typeof response === 'string' ? JSON.parse(response) : response;
                          if (ubicaciones.codigo === 0) {
                            $('#ubicacionE').empty();
                            $('#ubicacionE').append('<option value="">Seleccione una Ubicación</option>');
                            ubicaciones.dato.forEach(function(ubicacion) {
                              $('#ubicacionE').append('<option value="' + ubicacion.id + '">' + ubicacion.nombre + '</option>');
                            });
                            $("#ubicacionE").val(nombre_ubicacion);
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
                    $("#modalCrud").modal('show');
                } else {
                    console.error('Error al obtener el bien informático:', data.mensaje);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
    } else {
        console.error('No se proporcionó ningún ID.');
    }
});

    $("#formEditarBienes").submit(function (e) {
          e.preventDefault();
          let codigo_uta = $("#codigoUTAE").val();
          let nombre = $("#nombreE").val();
          let modelo = $("#modeloE").val();
          let id_marca = $("#marcaE").val();
          let serie = $("#serieE").val();
          let id_area_per = $("#areaE").val();
          let id_ubi_per = $("#ubicacionE").val();
          let id = $("#idE").val();
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
              }
          });
        });

  })
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