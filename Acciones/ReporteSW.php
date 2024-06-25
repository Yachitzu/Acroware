<?php

$op = $_SERVER["REQUEST_METHOD"];
if ($op == "POST" && $_POST["tipoArchivoSW"] == "pdf") {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 210mm;
            margin: 0 auto;
            padding: 20mm;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            page-break-inside: avoid;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            page-break-inside: avoid;
            page-break-after: auto;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
        @media print {
            body {
                margin: 0;
            }
            .container {
                box-shadow: none;
                width: 100%;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CODECRAFTERS</h1>
        <img src="../resources/images/logos/acroware-mini.png" alt="Logo" style="float: right; width: 50px;">
        <h2>REPORTE DE SOFTWARE</h2>
        <table>
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>ACTIVO</th>
                    <th>FECHA DE COMPRA</th>
                    <th>FECHA DE ACTIVACION</th>
                </tr>
            </thead>
            <tbody>
<?php
   
   include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
   $conexion = Conexion::getInstance()->getConexion();
   $licencia = $_POST["licenciaSW"];
   $activo = $_POST["activoSW"];
   $fechaIni = $_POST["fechaInicialSW"];
   $fechaFin = $_POST["fechaFinalSW"];
   $dato;
   $resultado='';
   if ($licencia == "any" && $activo == "any") {
      $consulta = "SELECT * FROM software WHERE (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }elseif ($licencia == "any" && $activo != "any") {
      $consulta = "SELECT * FROM software WHERE activado = :activo AND (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':activo', $activo);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }elseif ($licencia != "any" && $activo == "any") {
      $consulta = "SELECT * FROM software WHERE tipo_licencia = :licencia AND (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':licencia', $licencia);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }else{
      $consulta = "SELECT * FROM software WHERE tipo_licencia = :licencia AND activado = :activo AND (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':licencia', $licencia);
      $resultado->bindParam(':activo', $activo);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }
   $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
   foreach ($dato as $respuesta) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_software']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['activado']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['fecha_adqui']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['fecha_activacion']) . "</td>";
                    echo "</tr>";
                }
            ?> 
            </tbody>
        </table>
        <div class="footer">
            <p>Informe generado el <span id="date"></span></p>
        </div>
    </div>
    <script>
        document.getElementById('date').textContent = new Date().toLocaleDateString();
    </script>
</body>
</html>

<?php
}else if ($op == "POST" && $_POST["tipoArchivoSW"] == "excel") {

   header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
   header('Content-Disposition: attachment; filename="ReporteSW.csv"');
   $salida = fopen('php://output', 'w');
   fputcsv($salida, array('Nombre', 'Proveedor', 'Activo', 'Tipo de licencia', 'Fecha de compra', 'Fecha de Activación'));
   include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

   $conexion = Conexion::getInstance()->getConexion();
   $conexion->exec("SET NAMES 'utf8'");
   $licencia = $_POST["licenciaSW"];
   $activo = $_POST["activoSW"];
   $fechaIni = $_POST["fechaInicialSW"];
   $fechaFin = $_POST["fechaFinalSW"];
   $dato;
   $resultado='';
   if ($licencia == "any" && $activo == "any") {
      $consulta = "SELECT * FROM software WHERE (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }elseif ($licencia == "any" && $activo != "any") {
      $consulta = "SELECT * FROM software WHERE activado = :activo AND (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':activo', $activo);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }elseif ($licencia != "any" && $activo == "any") {
      $consulta = "SELECT * FROM software WHERE tipo_licencia = :licencia AND (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':licencia', $licencia);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }else{
      $consulta = "SELECT * FROM software WHERE tipo_licencia = :licencia AND activado = :activo AND (fecha_adqui >= :fechaIni AND fecha_adqui <= :fechaFin)";
      $resultado = $conexion->prepare($consulta);
      $resultado->bindParam(':licencia', $licencia);
      $resultado->bindParam(':activo', $activo);
      $resultado->bindParam(':fechaIni', $fechaIni);
      $resultado->bindParam(':fechaFin', $fechaFin);
      $resultado->execute();
   }
   $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach ($dato as $respuesta) {
         fputcsv($salida, array(
             $respuesta['nombre_software'],
             $respuesta['proveedor'],
             $respuesta['activado'],
             $respuesta['tipo_licencia'],
             $respuesta['fecha_adqui'],
             $respuesta['fecha_activacion']
         ));
     }
}else{
   echo "aquí no encuentra nada si no envía info";
}
