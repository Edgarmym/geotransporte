<?php
    // RECIBE DATOS JSON POST DEL JAVASCRIT
    $id = $_POST['id'];
    $nombre = $_POST['a'];
    $paterno = $_POST['b'];
    $materno = $_POST['c'];
    $r_social = $_POST['d'];
    $fecha = $_POST['e'];
    $hora = $_POST['ee'];
    $fecha_hora =$fecha.' '.$hora;
    $nit = $_POST['f'];
    $direc = $_POST['g'];
    $cel = $_POST['h'];
    $fijo = $_POST['i'];
    $vehi = $_POST['j'];// placa
    $tipo = $_POST['k'];
    $aseg = $_POST['l'];
    $mail = $_POST['m'];
    //---vehiculos
    $marca = $_POST['n'];
    $modelo = $_POST['o'];
    $color = $_POST['p'];
    
    if($aseg ==''){
        $aseg = '0';
    }

    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=localhost;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn_v = new PDO('pgsql:host=localhost;port=5432;dbname=bd_general', $u, $p);
        $conn_v->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        if ($id == 0) {
            $sql = $conn->prepare("INSERT INTO clientes (nombres, ap_paterno, ap_materno, r_social, fecha, nit, direccion, tel_cel, tel_fijo, id_vehiculo, tipo_cliente, id_aseguradora, correo) VALUES ('$nombre','$paterno','$materno','$r_social','$fecha_hora','$nit','$direc','$cel','$fijo','$vehi','$tipo','$aseg','$mail');");
            $sql_v = $conn_v->prepare("INSERT INTO vehiculos (placa, marca, modelo, color, fecha) VALUES ('$vehi','$marca','$modelo','$color','$fecha_hora');");
        } else {
            $sql = $conn->prepare("UPDATE clientes SET nombres='$nombre', ap_paterno='$paterno', ap_materno='$materno', r_social='$r_social', direccion='$direc', tel_cel='$cel', tel_fijo='$fijo', tipo_cliente='$tipo', id_vehiculo='$vehi', id_aseguradora='$aseg', nit='$nit', correo='$mail' WHERE id ='$id' ;");
            $sql_v = $conn->prepare("UPDATE vehiculos SET placa='$vehi', marca='$marca', modelo='$modelo', color='$color' WHERE id ='$id' ;");
        }
        $sql_v->execute(); //&& 
        usleep(500000);
        //DEVUELDE DATOS AL JAVASCRIT
        if ($sql->execute()) { 
            echo ("exito");
        }else{
            echo "No se puede registar el dato";
        }
        $conn = null;
        $sql = null;
        $conn_v = null;
        $sql_v = null;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
    
?>