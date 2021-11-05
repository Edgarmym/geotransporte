<?php
    // RECIBE DATOS JSON POST DEL JAVASCRIT
    $id = $_POST['id'];
    $r_social = $_POST['d'];
    $nit = $_POST['f'];
    $cel = $_POST['h'];
    $fijo = $_POST['i'];
    $tipo = $_POST['k'];
    $mail = $_POST['m'];
    
    if($aseg ==''){
        $aseg = '0';
    }

    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=192.168.100.3;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        if ($id == 0) {   //INSERT INTO aseguradoras(r_social, tel_cel, tel_fijo, correo, nit, tipo_tarifa) VALUES (?, ?, ?, ?, ?, ?, ?);
            $sql = $conn->prepare("INSERT INTO aseguradoras (r_social, tel_cel, tel_fijo, correo, nit, tipo_tarifa) VALUES ('$r_social','$cel','$fijo','$mail','$nit','$tipo');");
        } else {
            $sql = $conn->prepare("UPDATE aseguradoras SET r_social='$r_social', tel_cel='$cel', tel_fijo='$fijo', tipo_tarifa='$tipo', nit='$nit', correo='$mail' WHERE id ='$id' ;");
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
