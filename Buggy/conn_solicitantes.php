<?php
    // RECIBE DATOS JSON POST DEL JAVASCRIT
    $id = $_POST['id'];
    $nombre = $_POST['a'];
    $paterno = $_POST['b'];
    $materno = $_POST['c'];
    $fecha = $_POST['e'];
    $hora = $_POST['ee'];
    $fecha_hora =$fecha.' '.$hora;
    $cel = $_POST['h'];
    $fijo = $_POST['i'];
    $mail = $_POST['m'];
    $asegu = $_POST['n'];
    
    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=192.168.100.3;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        if ($id == 0) {
            $sql = $conn->prepare("INSERT INTO solicitantes (nombres, ap_paterno, ap_materno, fecha, tel_cel, tel_fijo, correo, id_aseguradora) VALUES ('$nombre','$paterno','$materno','$fecha_hora','$cel','$fijo','$mail', '$asegu');");
        } else {
            $sql = $conn->prepare("UPDATE solicitantes SET nombres='$nombre', ap_paterno='$paterno', ap_materno='$materno', tel_cel='$cel', tel_fijo='$fijo', correo='$mail', id_aseguradora='$asegu' WHERE id ='$id' ;");
        }
        
        //DEVUELDE DATOS AL JAVASCRIT
        if ($sql->execute()) { 
            echo ("exito");
        }else{
            echo "No se puede registar el dato";
        }
        $conn = null;
        $sql = null;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
    
?>
