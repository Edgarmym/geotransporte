<?php
include "fpdf/fpdf.php";
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B', 10);
//Margen decorativo iniciando en 0, 0
$pdf->Image('../img/principal.jpg', 0,0, 21, 29, 'JPG');
 
//Imagen izquierda
$pdf->Image('../img/principal.jpg', 25, 25, 17, 25, 'JPG');
 
//Imagen derecha
$pdf->Image('../img/principal.jpg', 155, 27, 25, 22, 'JPG');
 
//Texto de Título
$pdf->SetXY(60, 25);
$pdf->MultiCell(65, 5, utf8_decode('AQUI PONDREMOS UN TÍTULO REPRESENTATIVO DE ALGUNA EMPRESA O INSTITUCIÓN'), 0, 'C');
 
//Texto Explicativo
$pdf->SetFont('Courier','', 7);
$pdf->SetXY(48, 45);
$pdf->MultiCell(100, 4, utf8_decode('AQUI PONDREMOS UN EXPLICACIÓN PARA DESCRIBIR ALGUN PROCESO O EL TIPO DE FORMATO QUE SE ESTA DEFINIENDO O CUALQUIER OTRA COSA :P'), 0, 'J');
 
//De aqui en adelante se colocan distintos métodos
//para diseñar el formato.
 
//Fecha
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(145,60);
$pdf->Cell(15, 8, 'FECHA:', 0, 'L');
$pdf->Line(163, 65.5, 185, 65.5);
 
//Nombre //Apellidos //DNI //TELEFONO
$pdf->SetXY(25, 80);
$pdf->Cell(20, 8, 'NOMBRE(S):', 0, 'L');
$pdf->Line(52, 85.5, 120, 85.5);
//*****
$pdf->SetXY(25,100);
$pdf->Cell(19, 8, 'APELLIDOS:', 0, 'L');
$pdf->Line(52, 105.5, 180, 105.5);
//*****
$pdf->SetXY(25, 120);
$pdf->Cell(10, 8, 'DNI:', 0, 'L');
$pdf->Line(35, 125.5, 90, 125.5);
//*****
$pdf->SetXY(110, 120);
$pdf->Cell(10, 8, utf8_decode('TELÉFONO:'), 0, 'L');
$pdf->Line(135, 125.5, 170, 125.5);
 
//LICENCIATURA  //CARGO   //CÓDIGO POSTAL
$pdf->SetXY(25, 140);
$pdf->Cell(10, 8, 'LINCECIATURA EN:', 0, 'L');
$pdf->Line(27, 154, 65, 154);
//*****
$pdf->SetXY(80, 140);
$pdf->Cell(10, 8, 'CARGO:', 0, 'L');
$pdf->Line(75, 154, 105, 154);
//*****
$pdf->SetXY(125, 140);
$pdf->Cell(10, 8, utf8_decode('CÓDIGO POSTAL:'), 0, 'L');
$pdf->Line(120, 154, 170, 154);
 
$pdf->Output(); //Salida al navegador
 
?>