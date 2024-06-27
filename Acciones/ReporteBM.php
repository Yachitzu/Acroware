
<?php
$op = $_SERVER["REQUEST_METHOD"];
if ($op == "POST" && $_POST["tipoArchivoBM"] == "pdf") {
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
        <h2>REPORTE DE BIENES MOBILIARIOS</h2>
        <table>
            <thead>
                <tr>
                    <th>CÓDIGO UTA</th>
                    <th>NOMBRE</th>
                    <th>CONDICIÓN</th>
                    <th>ÁREA</th>
                    <th>UBICACIÓN</th>
                    <th>CUSTODIO ACTUAL</th>
                </tr>
            </thead>
            <tbody>
<?php
   include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

   $conexion = Conexion::getInstance()->getConexion();
   $custodio = $_POST['custodioM'];
   $area = $_POST["areaM"];
   $marca = $_POST["marcaM"];
   $fechaIni = $_POST["fechaInicialM"];
   $fechaFin = $_POST["fechaFinalM"];
   $dato;
   $resultado='';
   if ($area == "any" && $marca == "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca == "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        bm.id_area_per = :area AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca != "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        bm.id_area_per = :area AND id_marca = :marca AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca == "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        bm.id_area_per = :area AND custodio_actual = :custodio AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area == "any" && $marca != "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        id_marca = :marca AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area == "any" && $marca != "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        custodio_actual = :custodio AND AND id_marca = :marca AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area == "any" && $marca == "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        custodio_actual = :custodio AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca != "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    WHERE 
                        custodio_actual = :custodio AND id_marca = :marca AND bm.id_area_per = :area AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin) and bm.activo='si'";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }

$dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($dato as $respuesta) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($respuesta['codigo_uta']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['condicion']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_area']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_ubicacion']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['custodio_actual']) . "</td>";
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
}else if ($op == "POST" && $_POST["tipoArchivoBM"] == "excel") {
    header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment; filename="ReporteBM.csv"');
 
    $salida = fopen('php://output', 'w');
    fputcsv($salida, array('Codigo Uta', 'Nombre' ,'Serie', 'Marca', 'Modelo','Color','Material','Dimensiones','Condicion','Custodio Actual','Fecha de ingreso','Valor Contable', 'Area', 'Ubicacion',  'Activo', 'Bloque'));
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
 
    $conexion = Conexion::getInstance()->getConexion();
   $custodio = $_POST['custodioM'];
   $area = $_POST["areaM"];
   $marca = $_POST["marcaM"];
   $fechaIni = $_POST["fechaInicialM"];
   $fechaFin = $_POST["fechaFinalM"];
   $dato;
   $resultado='';
   if ($area == "any" && $marca == "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    WHERE 
                        (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca == "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    WHERE 
                        bm.id_area_per = :area AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca != "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    WHERE 
                        bm.id_area_per = :area AND id_marca = :marca AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca == "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bm.custodio_actual = usu.id
                    INNER JOIN 
                        bloques b ON bm.id_blo_per = b.id
                    WHERE 
                        bm.id_area_per = :area AND custodio_actual = :custodio AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area == "any" && $marca != "any" && $custodio == "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bm.custodio_actual = usu.id
                    INNER JOIN 
                        bloques b ON bm.id_blo_per = b.id
                    WHERE 
                        id_marca = :marca AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area == "any" && $marca != "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bm.custodio_actual = usu.id
                    INNER JOIN 
                        bloques b ON bm.id_blo_per = b.id
                    WHERE 
                        custodio_actual = :custodio AND AND id_marca = :marca AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area == "any" && $marca == "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bm.custodio_actual = usu.id
                    INNER JOIN 
                        bloques b ON bm.id_blo_per = b.id
                    WHERE 
                        custodio_actual = :custodio AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif ($area != "any" && $marca != "any" && $custodio != "any") {
        $consulta = "SELECT 
                        bm.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bm.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bm.custodio_actual = usu.id
                    INNER JOIN 
                        bloques b ON bm.id_blo_per = b.id
                    WHERE 
                        custodio_actual = :custodio AND id_marca = :marca AND bm.id_area_per = :area AND (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':custodio', $custodio);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }

    $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dato as $respuesta) {
        fputcsv($salida, array($respuesta['codigo_uta'],
        $respuesta['nombre'],
        $respuesta['serie'],
        $respuesta['nombre_marca'],
        $respuesta['modelo'],
        $respuesta['color'],
        $respuesta['material'],
        $respuesta['dimensiones'],
        $respuesta['condicion'],
        $respuesta['custodio'],
        $respuesta['fecha_ingreso'],
        $respuesta['valor_contable'],
        $respuesta['precio'],
        $respuesta['nombre_area'],
        $respuesta['nombre_ubicacion'],
        $respuesta['activo'],
        $respuesta['nombre_bloque']));
    }
}else{
   echo "aquí no encuentra nada si no envía info";
}
