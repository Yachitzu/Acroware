<?php
$op = $_SERVER["REQUEST_METHOD"];
if ($op == "POST" && $_POST["tipoArchivoI"] == "pdf") {
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
        <h2>REPORTE DE BIENES INFORMÁTICOS</h2>
        <table>
            <thead>
                <tr>
                    <th>CÓDIGO UTA</th>
                    <th>NOMBRE</th>
                    <th>FECHA ADQUISICIÓN</th>
                    <th>ÁREA</th>
                    <th>Ubicación</th>
                    <th>IP</th>   
                </tr>
            </thead>
            <tbody>
            <?php
                include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
                $conexion = Conexion::getInstance()->getConexion();
                $area = $_POST["areaI"];
                $marca = $_POST["marcaI"];
                $fechaIni = $_POST["fechaInicialI"];
                $fechaFin = $_POST["fechaFinalI"];
                $dato;
                $resultado = '';
                
                if ($area == "any" && $marca == "any") {
                    $consulta = "SELECT 
                                    bi.*,
                                    a.nombre as nombre_area,
                                    u.nombre as nombre_ubicacion
                                FROM 
                                    bienes_informaticos bi
                                INNER JOIN 
                                    areas a ON bi.id_area_per = a.id
                                INNER JOIN 
                                    ubicaciones u ON bi.id_ubi_per = u.id
                                WHERE 
                                    (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin) and bi.activo='si'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->bindParam(':fechaIni', $fechaIni);
                    $resultado->bindParam(':fechaFin', $fechaFin);
                    $resultado->execute();
                } elseif($area == "any" && $marca != "any") {
                    $consulta = "SELECT 
                                    bi.*,
                                    a.nombre as nombre_area,
                                    u.nombre as nombre_ubicacion
                                FROM 
                                    bienes_informaticos bi
                                INNER JOIN 
                                    areas a ON bi.id_area_per = a.id
                                INNER JOIN 
                                    ubicaciones u ON bi.id_ubi_per = u.id
                                WHERE 
                                    id_marca = :marca AND (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin) and bi.activo='si'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->bindParam(':marca', $marca);
                    $resultado->bindParam(':fechaIni', $fechaIni);
                    $resultado->bindParam(':fechaFin', $fechaFin);
                    $resultado->execute();
                } elseif($area != "any" && $marca == "any") {
                    $consulta = "SELECT 
                                    bi.*,
                                    a.nombre as nombre_area,
                                    u.nombre as nombre_ubicacion
                                FROM 
                                    bienes_informaticos bi
                                INNER JOIN 
                                    areas a ON bi.id_area_per = a.id
                                INNER JOIN 
                                    ubicaciones u ON bi.id_ubi_per = u.id
                                WHERE 
                                    bi.id_area_per = :area AND (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin) and bi.activo='si'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->bindParam(':area', $area);
                    $resultado->bindParam(':fechaIni', $fechaIni);
                    $resultado->bindParam(':fechaFin', $fechaFin);
                    $resultado->execute();
                } else {
                    $consulta = "SELECT 
                                    bi.*,
                                    a.nombre as nombre_area,
                                    u.nombre as nombre_ubicacion
                                FROM 
                                    bienes_informaticos bi
                                INNER JOIN 
                                    areas a ON bi.id_area_per = a.id
                                INNER JOIN 
                                    ubicaciones u ON bi.id_ubi_per = u.id
                                WHERE 
                                    id_marca = :marca AND bi.id_area_per = :area AND (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin) and bi.activo='si'";
                    $resultado = $conexion->prepare($consulta);
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
                    echo "<td>" . htmlspecialchars($respuesta['fecha_ingreso']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_area']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_ubicacion']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['ip']) . "</td>";
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
}else if ($op == "POST" && $_POST["tipoArchivoI"] == "excel") {
    header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment; filename="ReporteBI.csv"');
 
    $salida = fopen('php://output', 'w');
    fputcsv($salida, array('Codigo Uta', 'Nombre', 'Serie', 'Marca', 'Modelo', 'Area', 'Ubicacion', 'IP','Fecha de ingreso', 'Activo', 'Custodio', 'Bloque'));
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
 
    $conexion = Conexion::getInstance()->getConexion();
    $area = $_POST["areaI"];
    $marca = $_POST["marcaI"];
    $fechaIni = $_POST["fechaInicialI"];
    $fechaFin = $_POST["fechaFinalI"];
    $dato;
    $resultado='';

    if ($area == "any" && $marca == "any") {
        $consulta = "SELECT 
                        bi.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as nombre_completo_custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_informaticos bi
                    INNER JOIN 
                        areas a ON bi.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bi.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bi.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bi.id_marca = usu.id
                    INNER JOIN 
                        bloques b ON bi.id_marca = b.id
                    WHERE 
                        (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif($area == "any" && $marca != "any") {
        $consulta = "SELECT 
                        bi.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as nombre_completo_custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_informaticos bi
                    INNER JOIN 
                        areas a ON bi.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bi.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bi.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bi.id_marca = usu.id
                    INNER JOIN 
                        bloques b ON bi.id_marca = b.id
                    WHERE  
                        id_marca = :marca AND (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':marca', $marca);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }elseif($area != "any" && $marca == "any") {
        $consulta = "SELECT 
                        bi.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as nombre_completo_custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_informaticos bi
                    INNER JOIN 
                        areas a ON bi.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bi.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bi.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bi.id_marca = usu.id
                    INNER JOIN 
                        bloques b ON bi.id_marca = b.id
                    WHERE 
                        bi.id_area_per = :area AND (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':area', $area);
        $resultado->bindParam(':fechaIni', $fechaIni);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->execute();
    }else {
        $consulta = "SELECT 
                        bi.*,
                        a.nombre as nombre_area,
                        u.nombre as nombre_ubicacion,
                        m.nombre as nombre_marca,
                        CONCAT(usu.nombre, ' ', usu.apellido) as nombre_completo_custodio,
                        b.nombre as nombre_bloque
                    FROM 
                        bienes_informaticos bi
                    INNER JOIN 
                        areas a ON bi.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bi.id_ubi_per = u.id
                    INNER JOIN 
                        marcas m ON bi.id_marca = m.id
                    INNER JOIN 
                        usuarios usu ON bi.id_marca = usu.id
                    INNER JOIN 
                        bloques b ON bi.id_marca = b.id
                    WHERE 
                        id_marca = :marca AND bi.id_area_per = :area AND (bi.fecha_ingreso >= :fechaIni AND bi.fecha_ingreso <= :fechaFin)";
        $resultado = $conexion->prepare($consulta);
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
        $respuesta['nombre_area'],
        $respuesta['nombre_ubicacion'],
        $respuesta['ip'],
        $respuesta['fecha_ingreso'],
        $respuesta['activo'],
        $respuesta['nombre_completo_custodio'],
        $respuesta['nombre_bloque'],
                              ));
    }
}else{
   echo "aquí no encuentra nada si no envía info";
}
