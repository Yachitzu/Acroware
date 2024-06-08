
<?php

header('Content-Type: application/json');
$op = $_SERVER["REQUEST_METHOD"];
if ($op == "POST" && $_POST["tipoArchivoBM"] == "pdf") {
   
   require_once('fpdf/fpdf.php'); //Llamando a la Libreria TCPDF
   class PDF extends FPDF
   {
      // Cabecera de página
      function Header()
      {
         $this->Image('../resources/images/logos/acroware-mini.png', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
         $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
         $this->Cell(95); // Movernos a la derecha
         $this->SetTextColor(0, 0, 0); //color
         //creamos una celda o fila
         $this->Cell(110, 15, utf8_decode('CODECRAFTERS'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
         $this->Ln(3); // Salto de línea
         $this->SetTextColor(103); //color
   
         /* TITULO DE LA TABLA */
         //color
         $this->SetTextColor(228, 100, 0);
         $this->Cell(100); // mover a la derecha
         $this->SetFont('Arial', 'B', 15);
         $this->Cell(100, 10, utf8_decode("REPORTE DE BIENES INFORMÁTICOS "), 0, 1, 'C', 0);
         $this->Ln(7);
   
         /* CAMPOS DE LA TABLA */
         //color
         $this->SetFillColor(228, 100, 0); //colorFondo
         $this->SetTextColor(255, 255, 255); //colorTexto
         $this->SetDrawColor(163, 163, 163); //colorBorde
         $this->SetFont('Arial', 'B', 11);
         $this->Cell(30, 10, utf8_decode('CÓDIGO UTA'), 1, 0, 'C', 1);
         $this->Cell(40, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
         $this->Cell(50, 10, utf8_decode('CONDICIÓN'), 1, 0, 'C', 1);
         $this->Cell(55, 10, utf8_decode('CUSTODIO'), 1, 0, 'C', 1);
         $this->Cell(55, 10, utf8_decode('ÁREA'), 1, 0, 'C', 1);
         $this->Cell(30, 10, utf8_decode('UBICACIÓN'), 1, 1, 'C', 1);
      }
   
      // Pie de página
      function Footer()
      {
         global $dato;
         $this->SetY(-15); // Posición: a 1,5 cm del final
         $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
         $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)
   
         $this->SetY(-15); // Posición: a 1,5 cm del final
         $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
         $hoy = date('d/m/Y');
         $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
      }
   }
   include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
   
   $pdf = new PDF();
   $pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
   $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
   
   $pdf->SetFont('Arial', '', 12);
   $pdf->SetDrawColor(163, 163, 163); //colorBorde

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
                        (bm.fecha_ingreso >= :fechaIni AND bm.fecha_ingreso <= :fechaFin)";
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
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
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
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
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
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
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
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
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
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
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
                        u.nombre as nombre_ubicacion
                    FROM 
                        bienes_mobiliarios bm
                    INNER JOIN 
                        areas a ON bm.id_area_per = a.id
                    INNER JOIN 
                        ubicaciones u ON bm.id_ubi_per = u.id
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
    /* TABLA */
    $pdf->Cell(30, 10, utf8_decode($respuesta['codigo_uta']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($respuesta['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($respuesta['condicion']), 1, 0, 'C', 0);
    $pdf->Cell(55, 10, utf8_decode($respuesta['custodio_actual']), 1, 0, 'C', 0); // nombre del área
    $pdf->Cell(55, 10, utf8_decode($respuesta['nombre_area']), 1, 0, 'C', 0); // nombre de la ubicación
    $pdf->Cell(30, 10, utf8_decode($respuesta['nombre_ubicacion']), 1, 1, 'C', 0);
}
   
   
   
   $pdf->Output('ReporteSW.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
}else if ($op == "POST" && $_POST["tipoArchivoBM"] == "excel") {
    header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment; filename="ReporteBM.csv"');
 
    $salida = fopen('php://output', 'w');
    fputcsv($salida, array('Codigo Uta', 'BLD/BCA', 'Nombre' ,'Serie', 'Marca', 'Modelo','Color','Material','Dimensiones','Condicion','Custodio Actual','Fecha de ingreso','Valor Contable','Precio', 'Area', 'Ubicacion',  'Activo'));
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
        $respuesta['bld_o_bca'],
        $respuesta['nombre'],
        $respuesta['serie'],
        $respuesta['nombre_marca'],
        $respuesta['modelo'],
        $respuesta['color'],
        $respuesta['material'],
        $respuesta['dimensiones'],
        $respuesta['condicion'],
        $respuesta['custodio_actual'],
        $respuesta['fecha_ingreso'],
        $respuesta['valor_contable'],
        $respuesta['precio'],
        $respuesta['nombre_area'],
        $respuesta['nombre_ubicacion'],
        $respuesta['activo']));
    }
}else{
   echo "aquí no encuentra nada si no envía info";
}
