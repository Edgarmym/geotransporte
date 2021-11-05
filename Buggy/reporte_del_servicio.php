<?php
include 'ws/conexion.php';
try {	
$pdo = new Conexion();
//$id = $_POST['id'];
$id = 1;
$sql = $pdo->prepare("SELECT s.id, s.id_equipo,s.id_tecnico,s.dir_asistencia,
s.dir_destino,s.dir_mapa,s.distancia_mapa,s.tiempo_mapa,
s.tarifa,s.costo, s.excedente, s.custodia, s.otros_costos,s.costo_total,
s.estado_cuenta, s.fecha_ini, s.fecha_fin,s.t_servicio,s.observaciones,c.nombres,c.ap_paterno,
c.ap_materno, c.r_social,c.tel_fijo,c.tel_cel
,a.r_social,a.correo,a.nit,a.tipo_tarifa,sl.id_aseguradora,sl.nombres as nomsoli,v.placa,v.marca,v.modelo,v.color FROM orden_servicio as s  
 INNER JOIN clientes as c ON c.id = s.id_cliente
 INNER JOIN aseguradoras as a ON a.id = s.id_aseguradora
 INNER JOIN solicitantes as sl ON sl.id = s.id_solicitante
 INNER JOIN vehiculos as v ON v.id = s.id_vehiculo
 where s.id=".$id);
 //INNER JOIN servicio as ci ON ci.id = s.id_servicio
 //INNER JOIN tecnico as t ON ci.id = s.id_tecnico
$sql->execute();
if ($sql) {
   
$data = $sql->fetchObject();
if (!empty($data) ) {
 
require ('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

//inserto la cabecera poniendo una imagen dentro de una celda
//$pdf->Cell(700,85,$pdf->Image('../img/icon_buggy.png',30,12,210,10),0,0,'C');
$pdf->Image('../img/icon_buggy.png',170,12,10,10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'DATOS DEL SERVICIO');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12,"Nro de Servicio: ".$data->id."    Fecha Inicial: ".$data->fecha_ini."    Fecha Final: ".$data->fecha_fin."    Tiempo de Servicio: ".$data->t_servicio );
//$pdf->Cell(100,12,"Fecha Inicial: ".$data->fecha_ini);
//$pdf->Cell(100,12,"Fecha Final: ".$data->fecha_fin);
//$pdf->Cell(100,12,"Tiempo de Servicio: ".$data->t_servicio);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'DATOS DEL CLIENTE/ASEGURADO');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12,"Nombre y Apellido: ".$data->nombres."  ".$data->ap_paterno."  ".$data->ap_materno."   Telefono/Celular: ".$data->tel_fijo." - ".$data->tel_cel);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'DATOS DEL ASISTENCIA');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12,"Direccion Asistencia: ".$data->dir_asistencia."    Direccion Destino: ".$data->dir_destino);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Line(10,10,190,10);
$pdf->Cell(100,12,'KILOMETRAJE');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12, "Distancia: ".$data->distancia_mapa."    Tiempo: ".$data->tiempo_mapa."      Destino ruta: ruta");
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'DATOS DEL VEHICULO');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Ln(7);
$pdf->Cell(100,12,"Marca: ".$data->marca."    Modelo: ".$data->modelo."      Color:".$data->color."      PLaca: ".$data->placa);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'DATOS DEL COSTO DEL SERVICIO');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12,"Costo: ".$data->costo."bs.    Rxedente:".$data->excedente."    Costo Total : ".$data->costo_total."bs.     Estado de Pago: ".$data->estado_cuenta);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'EQUIPOS Y TECNICO');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12,"Equipo: ".$data->id_equipo."      Tecnico: ".$data->id_tecnico);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,255);
$pdf->Cell(100,12,'Observaciones');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0,0);
$pdf->Cell(100,12,".$data->observaciones.");

$pdf->Ln(5);
$pdf->Output();
 }
 else{
    echo "verificar los datos antes ce imprimir..";
 }

}else{
    echo "No se puede registar el dato";
}
//pg_close($pdo);
} catch (PDOException $e) {
echo "ERROR: " . $e->getMessage();
}
?>