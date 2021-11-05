<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// utilizamos la funcion Header() y la personalizamos para que muestre la cabecera de página
function Header()
{

// seteamos el tipo de letra Arial Negrita 16
$this->SetFont('Arial','B',16);

// ponemos una celda sin contenido para centrar el titulo o la celda del titulo a la derecha
$this->Cell(50);
 
// definimos la celda el titulo
$this->Cell(100,10,'Reporte de Cobros',0,0,'C');

// Salto de línea salta 20 lineas
$this->Ln(20);

}

// utilizamos la funcion Footer() y la personalizamos para que muestre el pie de página
function Footer()

{
// Seteamos la posicion de la proxima celda en forma fija a 1,5 cm del final de la pagina

$this->SetY(-15);
// Seteamos el tipo de letra Arial italica 10

$this->SetFont('Arial','I',10);
// Número de página

$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

}

//$pdf->SetFont('Arial','B',16);
//$pdf->Cell(40,10,utf8_decode('Hello World!'));
try {
    //CONSULTAR DATOS EN BD
    $u = "postgres";
    $p = "postgres";
    $conn = pg_connect('host=localhost port=5432 dbname=sysbuggys user=postgres password=admin', $u, $p);
   // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //EJECUTA CONSULTA
    $sql ="SELECT * FROM orden_servicio";
    $result= pg_exec($conn,$sql);
    //DEVUELDE DATOS AL JAVASCRIT
    $cont = pg_numrows($result);
    
    while ($arr=pg_fetch_array($result))
    {
        $arr["id"];
    }
    
    pg_close($conn);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

//Conecto a la base de datos
//$enlace = mysql_connect("localhost", "root");

//mysql_select_db("mercado", $enlace);
//Consulta la tabla productos solicitando todos los productos

//$resultado = mysql_query("SELECT * FROM productos", $link);


 
//Instaciamos la clase para genrear el documento pdf
//$pdf=new FPDF();
$pdf = new PDF();

//Agregamos la primera pagina al documento pdf

$pdf->AddPage();


$y_axis_initial = 25;

//Seteamos el tiupo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial','B',12);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE COBROS',1,0,'C');

$pdf->Ln(10);

//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(125,6,'Titulo',1,0,'C',1);

$pdf->Cell(30,6,'Precio',1,0,'C',1);
$pdf->Cell(30,6,'Foto',1,0,'C',1);

$pdf->Ln(10);

//Comienzo a crear las fiulas de productos según la consulta MySQL
/*
while($fila = mysql_fetch_array($resultado))
{

$titulo = $fila['titulo'];

$precio = $fila['precio'];
$imagen="fotos/".$row['imagen1'];

$pdf->Cell(125,15,$titulo,1,0,'L',0);

$pdf->Cell(30,15,$precio,1,0,'R',1);
//Muestro la iamgen dentro de la celda GetX y GetY dan las coordenadas actuales de la fila

$pdf->Cell( 30, 15, $pdf->Image($imagen, $pdf->GetX()+5, $pdf->GetY()+3, 20), 1, 0, 'C', false );

$pdf->Ln(15);

}

mysql_close($enlace);*/

//Mostramos el documento pdf
$pdf->Output();
//$pdf->Output();
?>