<?php 
    //$poiid = $_GET["poiid"];
    
    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=localhost;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        $sql = $conn->prepare("SELECT * FROM aseguradoras ORDER BY id");
        //$sql->execute();
        //DEVUELDE DATOS AL JAVASCRIT

        $sql->execute();
                
        $respuesta = $sql->fetchAll(PDO::FETCH_OBJ); //PDO::FETCH_OBJ
        
        $q =$sql->rowCount();
        if ($q > 0) {
            //print_r ($respuesta); para probar en pantalla
            echo json_encode($respuesta);
        }else{
            echo "No hay registros que mostar";
        }
        $conn = null;
        $sql = null;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }

?>