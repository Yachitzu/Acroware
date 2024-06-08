<?php

header('Content-Type: application/json');
$op = $_SERVER["REQUEST_METHOD"];
if ($op == "POST" && $_POST["tipoArchivoSW"] == "pdf") {
   
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
         $this->Cell(100, 10, utf8_decode("REPORTE DE BIENES DE SOFTWARE "), 0, 1, 'C', 0);
         $this->Ln(7);
   
         /* CAMPOS DE LA TABLA */
         //color
         $this->SetFillColor(228, 100, 0); //colorFondo
         $this->SetTextColor(255, 255, 255); //colorTexto
         $this->SetDrawColor(163, 163, 163); //colorBorde
         $this->SetFont('Arial', 'B', 11);
         $this->Cell(30, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
         $this->Cell(40, 10, utf8_decode('PROVEEDOR'), 1, 0, 'C', 1);
         $this->Cell(30, 10, utf8_decode('ACTIVO'), 1, 0, 'C', 1);
         $this->Cell(55, 10, utf8_decode('TIPO DE LICENCIA'), 1, 0, 'C', 1);
         $this->Cell(55, 10, utf8_decode('FECHA DE COMPRA'), 1, 0, 'C', 1);
         $this->Cell(55, 10, utf8_decode('FECHA DE ACTIVACIÓN'), 1, 1, 'C', 1);
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
      /* TABLA */
      $pdf->Cell(30, 10, utf8_decode($respuesta['nombre_software']), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode($respuesta['proveedor']), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode($respuesta['activado']), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode($respuesta['tipo_licencia']), 1, 0, 'C', 0);
      $pdf->Cell(85, 10, utf8_decode($respuesta['fecha_adqui']), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode($respuesta['fecha_activacion']), 1, 1, 'C', 0);
   }
   
   
   
   $pdf->Output('ReporteSW.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
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
