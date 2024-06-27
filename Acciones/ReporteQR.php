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
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
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
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CODECRAFTERS</h1>
        <img src="../resources/images/logos/acroware-mini.png" alt="Logo" style="float: right; width: 50px;">
        <h2>REPORTE DE ETIQUETAS QR</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CÓDIGO UTA</th>
                    <th>ÁREA</th>
                    <th>UBICACIÓN</th>
                    <th>QR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
                $conexion = Conexion::getInstance()->getConexion();
                $area = $_POST["areaQR"];
                $dato;
                $resultado='';
                if ($area == "any" ) {
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
                                     bi.activo ='si'";
                     $resultado = $conexion->prepare($consulta);
                     $resultado->execute();
                 }elseif($area != "any") {
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
                                     bi.id_area_per = :area and bi.activo ='si'";
                     $resultado = $conexion->prepare($consulta);
                     $resultado->bindParam(':area', $area);
                     $resultado->execute();
                 }else {
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
                                     bi.activo ='si'";
                     $resultado = $conexion->prepare($consulta);
                     $resultado->bindParam(':area', $area);
                     $resultado->execute();
                 }
             
             $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
             foreach ($dato as $respuesta) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($respuesta['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['codigo_uta']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_area']) . "</td>";
                    echo "<td>" . htmlspecialchars($respuesta['nombre_ubicacion']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($respuesta['qr']) . "' alt='QR Code' style='width: 100px;'></td>";
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
        // Script para mostrar la fecha actual en el pie de página
        document.getElementById('date').textContent = new Date().toLocaleDateString();
    </script>
</body>
</html>
