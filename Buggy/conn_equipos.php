<?php
    // RECIBE DATOS JSON POST DEL JAVASCRIT
    $id = $_POST['id'];
    $marca = $_POST['a'];
    $modelo = $_POST['b'];
    $color = $_POST['c'];
    $placa = $_POST['d'];
    $fecha = $_POST['e'];
    $hora = $_POST['ee'];
    $fecha_hora =$fecha.' '.$hora;
    $tipo = $_POST['f'];
    
    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=192.168.100.3;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        if ($id == 0) {
            $sql = $conn->prepare("INSERT INTO equipos (marca, modelo, color, placa, fecha, tipo) VALUES ('$marca','$modelo','$color','$placa','$fecha_hora','$tipo');");
        } else {
            $sql = $conn->prepare("UPDATE equipos SET marca='$marca', modelo='$modelo', color='$color', placa='$placa', tipo='$tipo' WHERE id ='$id';");
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
