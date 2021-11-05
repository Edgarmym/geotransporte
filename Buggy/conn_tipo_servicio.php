<?php
    
    // RECIBE DATOS JSON POST DEL JAVASCRIT
    $tiposervicio = $_POST['tipo'];
    $idtipo = $_POST['idtipo'];


    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=localhost;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        if ($idtipo == 0) {
            $sql = $conn->prepare("INSERT INTO tipo_servicio(tipo) VALUES ('$tiposervicio');");
        } else {
            $sql = $conn->prepare("UPDATE tipo_servicio SET tipo='$tiposervicio' WHERE id ='$idtipo' ;");
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