<?php 
    //$poiid = $_GET["poiid"];
    
    try {
        //CONSULTAR DATOS EN BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=localhost;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        //$sql = $conn->prepare("SELECT * FROM clientes ORDER BY id DESC");
        $sql = $conn->prepare("SELECT c.id, c.nombres, c.ap_paterno, c.ap_materno, c.r_social, c.fecha, c.direccion, c.tipo_cliente, c.id_aseguradora, c.tel_fijo, c.nit, c.tel_cel, c.correo, v.id as id_tablaVehiculo, v.placa as id_vehiculo, v.marca, v.modelo, v.color FROM clientes as c INNER JOIN vehiculos as v ON c.id = v.id_cliente ORDER BY c.id DESC;");
        
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