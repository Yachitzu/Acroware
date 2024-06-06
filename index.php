<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['email']) || $_SESSION['rol'] != 'admin') {
  header('Location: pages/login/login.php');
  exit;
} else {
  $_SESSION['email'];
}

require_once __DIR__ . '/Acciones/contador.php';

$bienes = obtenerBienesMobiliariosRecientes();

// Verificar si $bienes es un array
if (!is_array($bienes)) {
    echo "Error: No se obtuvo un array.";
    var_dump($bienes);
    exit;
}

$usuario_id = $_SESSION['id'];
$basePath = $_SERVER['DOCUMENT_ROOT'] . '/Acroware/';
$recordatorios = obtenerRecordatoriosPendientes($usuario_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard - Acroware</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="resources/vendors/feather/feather.css">
  <link rel="stylesheet" href="resources/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="resources/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="resources/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="resources/vendors/ti-icons/css/themify-icons.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="resources/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="resources/images/logos/Australian_STEM_Video_Game_Challenge-removebg-preview5.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="resources/images/logos/Acroware.png"
            class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="resources/images/logos/acroware-mini.png"
            alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
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
              <img src="resources/images/faces/perfil1.png" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="pages/others/acount.php">
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
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/management/users.php">
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
                <li class="nav-item"> <a class="nav-link" href="pages/places/faculty.php">Facultades</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/places/block.php">Bloques</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/places/area.php">Áreas</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/places/location.php">Ubicaciones</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/management/marca.php">
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
                <li class="nav-item"> <a class="nav-link" href="pages/assets/assets-i.php">Bienes Informáticos</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/assets/repowering.php">Repotenciación</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/assets/assets-m.php">Bienes Mobiliarios</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/management/software.php">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Software</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="pages/others/report.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Reporte</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/others/QR.php">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Escaneo QR</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pages/others/acount.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Cuenta</span>
            </a>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">¡Bienvenido a Acroware!</h3>
                  <h6 class="font-weight-normal mb-0">¡Gestión Inteligente!</h6>
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Hoy (08 Abril 2024)
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">Enero - Junio</a>
                        <a class="dropdown-item" href="#">Junio - Diciembre</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="resources/images/dashboard/4959495-removebg-preview.png" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div class="result">
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-bold">Ambato</h4>
                        <h6 class="font-weight-bold">Ecuador</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Número Total</p>
                      <p class="fs-30 mb-2"><i class="ti-layers"></i><?php echo contarSoftware(); ?></p>
                      <p>Software</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                      <div class="card-body">
                          <!-- Icono de un frasco de laboratorio -->
                          <p class="mb-4">Número Total </p>
                          <p class="fs-30 mb-2"><i class="ti-user"></i> <?php echo contarLaboratoristas(); ?></p>
                          <p>Laboratoristas</p>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Número Total</p>
                      <p class="fs-30 mb-2"><i class="ti-desktop"></i><?php echo contarBienesInformaticos(); ?></p>
                      <p>Bienes</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Número Total</p>
                      <p class="fs-30 mb-2"><i class="ti-panel"></i><?php echo contarComponentes(); ?></p>
                      <p>Componentes</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <?php
                // Incluir el archivo de funciones
                include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/Acciones/recordatorios/procesar_seleccion.php');

                // Obtener opciones de facultades
                $facultades = obtenerFacultades();
            ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <form id="seleccion-form" method="POST" action="Acciones/recordatorios/procesar_seleccion.php">
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <select id="facultad" name="facultad" class="form-control" required>
                            <option value="">Selecciona una facultad</option>
                            <?php foreach ($facultades as $facultad): ?>
                              <option value="<?php echo $facultad['id']; ?>"><?php echo htmlspecialchars($facultad['nombre']); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group col-md-5">
                          <select id="bloque" name="bloque" class="form-control" required disabled>
                            <option value="">Selecciona una facultad primero</option>
                          </select>
                        </div>
                      </div>
                  </form>
                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                    data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                              <p class="card-title">Detalles por Áreas</p>
                              <h1 class="text-primary">---</h1>
                              <h3 class="font-weight-500 mb-xl-4 text-primary">---</h3>
                              <p class="mb-2 mb-xl-0">¡Bienvenido a nuestra sección de Información por Áreas! Aquí
                                encontrarás un desglose detallado de los bienes mobiliarios, tecnológicos y software
                                disponibles en cada Área de nuestra Facultad.</p>
                            </div>
                          </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
                                    <tr>
                                      <td class="text-muted">---</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">0</h5>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">---</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">0</h5>
                                      </td>
                                    </tr>
                                    
                                    
                                  </table>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Siguiente</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script>
              document.getElementById('facultad').addEventListener('change', function() {
                  var facultadId = this.value;
                  var bloqueSelect = document.getElementById('bloque');
                  var button = document.querySelector('button[type="submit"]');
                  if (facultadId) {
                      bloqueSelect.innerHTML = '<option value="">Cargando...</option>';
                      button.disabled = true;
                      fetch('Acciones/recordatorios/procesar_seleccion.php?accion=obtenerBloques&facultad=' + facultadId)
                          .then(response => response.json())
                          .then(data => {
                              bloqueSelect.innerHTML = '<option value="">Selecciona un bloque</option>';
                              data.forEach(bloque => {
                                  var option = document.createElement('option');
                                  option.value = bloque.id;
                                  option.textContent = bloque.nombre;
                                  bloqueSelect.appendChild(option);
                              });
                              bloqueSelect.disabled = false;
                              button.disabled = false;
                          })
                          .catch(error => {
                              console.error('Error al obtener bloques:', error);
                              bloqueSelect.innerHTML = '<option value="">Error al cargar los bloques</option>';
                          });
                  } else {
                      bloqueSelect.innerHTML = '<option value="">Selecciona una facultad primero</option>';
                      bloqueSelect.disabled = true;
                      button.disabled = true;
                  }
              });


              document.getElementById('facultad').addEventListener('change', function() {
        var facultadId = this.value;
        var bloqueSelect = document.getElementById('bloque');
        var button = document.querySelector('button[type="submit"]');
        if (facultadId) {
            bloqueSelect.innerHTML = '<option value="">Cargando...</option>';
            button.disabled = true;
            fetch('Acciones/recordatorios/procesar_seleccion.php?accion=obtenerBloques&facultad=' + facultadId)
                .then(response => response.json())
                .then(data => {
                    bloqueSelect.innerHTML = '<option value="">Selecciona un bloque</option>';
                    data.forEach(bloque => {
                        var option = document.createElement('option');
                        option.value = bloque.id;
                        option.textContent = bloque.nombre;
                        bloqueSelect.appendChild(option);
                    });
                    bloqueSelect.disabled = false;
                    button.disabled = false;
                })
                .catch(error => {
                    console.error('Error al obtener bloques:', error);
                    bloqueSelect.innerHTML = '<option value="">Error al cargar los bloques</option>';
                });
        } else {
            bloqueSelect.innerHTML = '<option value="">Selecciona una facultad primero</option>';
            bloqueSelect.disabled = true;
            button.disabled = true;
        }
    });

    document.getElementById('bloque').addEventListener('change', function() {
    var bloqueId = this.value;
    if (bloqueId) {
        var facultadId = document.getElementById('facultad').value;
        fetch('Acciones/contador.php?facultad=' + facultadId + '&bloque=' + bloqueId)
            .then(response => response.json())
            .then(data => {
                var carouselItems = document.querySelector('.carousel-inner');
                carouselItems.innerHTML = '';

                var areasPorPiso = data.areasPorPiso;
                var areasPorEncargado = data.areasPorEncargado;

                // Colores para las barras de progreso
                var colors = ['bg-primary', 'bg-warning', 'bg-danger', 'bg-info'];
                var colorIndex = 0;

                Object.keys(areasPorPiso).forEach(piso => {
                    var areas = areasPorPiso[piso];
                    var carouselItem = document.createElement('div');
                    carouselItem.classList.add('carousel-item');

                    var areasHTML = areas.map(area => {
                        // Seleccionar color y avanzar el índice
                        var progressBarColor = colors[colorIndex % colors.length];
                        colorIndex++;

                        return `
                            <tr>
                                <td class="text-muted">${area.nombre}</td>
                                <td class="w-100 px-0">
                                    <div class="progress progress-md mx-4">
                                        <div class="progress-bar ${progressBarColor}" role="progressbar" style="width: 100%"
                                             aria-valuenow="${area.total_ubicaciones}" aria-valuemin="0" aria-valuemax="25"></div>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-weight-bold mb-0">${area.total_ubicaciones}</h5>
                                </td>
                            </tr>
                        `;
                    }).join('');

                    var innerHTML = `
                        <div class="row">
                            <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                <div class="ml-xl-4 mt-3">
                                    <p class="card-title">Detalles por Áreas</p>
                                    <h1 class="text-primary">${piso}</h1>
                                    <h3 class="font-weight-500 mb-xl-4 text-primary">${areas[0].nombre_bloque}</h3>
                                    <p class="mb-2 mb-xl-0">¡Bienvenido a nuestra sección de Información por Áreas! Aquí encontrarás un desglose detallado de los bienes mobiliarios, tecnológicos y software disponibles en cada Área de nuestra Facultad.</p>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-9">
                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <div class="table-responsive mb-3 mb-md-0 mt-3">
                                            <table class="table table-borderless report-table">
                                                ${areasHTML}
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                      <canvas id="floor-managers-chart-${piso}"></canvas>
                                      <div id="floor-managers-legend-${piso}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    carouselItem.innerHTML = innerHTML;
                    carouselItems.appendChild(carouselItem);

                    // Inicializar el gráfico
                    var ctx = document.getElementById(`floor-managers-chart-${piso}`).getContext('2d');
                    var floorManagersChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: areasPorEncargado[piso].map(enc => enc.encargado),
                            datasets: [{
                                data: areasPorEncargado[piso].map(enc => enc.total_areas),
                                backgroundColor: ['#4B49AC', '#FFC100', '#248AFD', '#28B463', '#E74C3C'],
                                borderColor: 'rgba(0,0,0,0)'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            cutoutPercentage: 78,
                            elements: {
                                arc: {
                                    borderWidth: 4
                                }
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                enabled: true
                            },
                            legendCallback: function(chart) {
                                var text = [];
                                chart.data.labels.forEach((label, index) => {
                                    var value = chart.data.datasets[0].data[index];
                                    text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[index] + '"></div><p class="mb-0">' + label + '</p></div>');
                                    text.push('<p class="mb-0">' + value + '</p>');
                                    text.push('</div>');
                                });
                                return text.join("");
                            },
                        },
                        plugins: [{
                            beforeDraw: function(chart) {
                                var width = chart.chart.width,
                                    height = chart.chart.height,
                                    ctx = chart.chart.ctx;

                                ctx.restore();
                                var fontSize = 3.125;
                                ctx.font = "500 " + fontSize + "em sans-serif";
                                ctx.textBaseline = "middle";
                                ctx.fillStyle = "#13381B";

                                var text = chart.data.datasets[0].data.reduce((a, b) => a + b, 0),
                                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                                    textY = height / 2;

                                ctx.fillText(text, textX, textY);
                                ctx.save();
                            }
                        }]
                    });
                    document.getElementById(`floor-managers-legend-${piso}`).innerHTML = floorManagersChart.generateLegend();
                });

                // Marcar el primer elemento como activo
                carouselItems.querySelector('.carousel-item').classList.add('active');
            })
            .catch(error => {
                console.error('Error al obtener áreas:', error);
                // Puedes mostrar un mensaje de error en caso de fallo
            });
    } else {
        // Si no se selecciona ningún bloque, se puede mostrar un mensaje o realizar alguna acción
    }
});

          </script>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Bienes Agregados Recientemente</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Codigo UTA</th>
                                        <th>Nombre</th>
                                        <th>Modelo</th>
                                        <th>Marca</th>
                                        <th>Ubicacion</th>
                                        <th>Activo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bienes as $bien): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($bien['codigo_uta']); ?></td>
                                            <td><?php echo htmlspecialchars($bien['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($bien['modelo']); ?></td>
                                            <td><?php echo htmlspecialchars($bien['marca']); ?></td>
                                            <td><?php echo htmlspecialchars($bien['id_ubi_per']); ?></td>
                                            <td class="font-weight-medium">
                                                <?php
                                                    $badge_class = $bien['activo'] === 'si' ? 'badge-success' : 'badge-danger';
                                                ?>
                                                <div class="badge <?php echo $badge_class; ?>">
                                                    <?php echo ucfirst(htmlspecialchars($bien['activo'])); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var usuarioId = <?php echo $usuario_id; ?>;
            </script>
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recordatorio</h4>
                        <div class="list-wrapper pt-2">
                            <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                <?php if (is_array($recordatorios) && count($recordatorios) > 0): ?>
                                    <?php foreach ($recordatorios as $recordatorio): ?>
                                        <li data-id="<?php echo $recordatorio['id']; ?>">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox">
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
                        <div class="add-items d-flex mb-0 mt-2">
                          <form id="add-todo-form" class="d-flex w-100">
                            <input type="hidden" class="form-control todo-list-input_id" name="usuario_id" value="<?php echo $usuario_id; ?>">
                            <input type="text" class="form-control todo-list-input" name="actividad" placeholder="Agregar nueva actividad">
                            <button type="submit" class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
                          </form>
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
          <a class="btn-crud btn-primary text-bold" href="cerrar.php">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>


  <!-- plugins:js -->
  <script src="resources/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="resources/vendors/chart.js/Chart.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="resources/js/off-canvas.js"></script>
  <script src="resources/js/hoverable-collapse.js"></script>
  <script src="resources/js/template.js"></script>
  <script src="resources/js/settings.js"></script>
  <script src="resources/js/clima.js"></script>
  <script src="resources/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="resources/js/Chart.roundedBarCharts.js"></script>
  <script src="resources/js/dashboard.js"></script>
</body>

</html>