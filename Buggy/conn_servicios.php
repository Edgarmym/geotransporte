<?php
    // RECIBE DATOS JSON POST DEL JAVASCRIT   a,b,c,d,e,f,g,gg,h,i,j,k,l,m,n,nn,o,p,q,r,s,t,u,v,w,x,y,yy,z,aa,bb,cc,tarea
    $id_cliente = $_POST['id_cli'];
    $id_tecnico = $_POST['b'];
    $id_tipo_servicio = $_POST['c'];
    $id_equipo = $_POST['d'];

    //$cliente = $_POST['e'];
    //$telefono = $_POST['f'];
    $fecha_ini = $_POST['g'];
    $hora_ini = $_POST['gg'];
    $fecha_hora_ini =$fecha_ini.' '.$hora_ini;

    //$marca_vehiculo = $_POST['h'];
    //$modelo_vehiculo = $_POST['i'];
    //$color_vehiculo = $_POST['j'];
    //$placa_vehiculo = $_POST['k'];
    
    $id_solicitante = $_POST['l'];
    //$id_compania = $_POST['m'];
    //$id_tarifa = $_POST['n'];
    $tarifa = $_POST['nn'];

    $direccion_asistencia = $_POST['o'];
    $direccion_destino = $_POST['p'];

    $mapa_dist = $_POST['q'];
    $mapa_tiempo = $_POST['r'];
    $mapa_direc = $_POST['s'];

    $costo = $_POST['t'];
    $excedente = $_POST['u'];
    $custodia = $_POST['v'];
    $costo_total = $_POST['w'];
    $id_estado_cuenta = $_POST['x'];

    $fecha_fin = $_POST['y'];
    $hora_fin = $_POST['yy'];
    $fecha_hora_fin =$fecha_fin.' '.$hora_fin;

    $tiempo_perdido = $_POST['z'];
    $tiempo_servicio = $_POST['aa'];
    $tiempo_efectivo = $_POST['bb'];
    $observaciones = $_POST['cc'];

    $tarea = $_POST['tarea'];

    if($id_solicitante ==''){
        $id_solicitante = 0;
    }
    if($excedente ==''){
        $excedente = 0;
    }
    if($custodia ==''){
        $custodia = 0;
    }
    

    try {
        //CONECTAR A BD
        $u = "postgres";
        $p = "postgres";
        $conn = new PDO('pgsql:host=localhost;port=5432;dbname=bd_general', $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //EJECUTA CONSULTA
        switch($tarea) {
            case 'insert':
                $sql = $conn->prepare("INSERT INTO orden_servicio (id_cliente, id_solicitante,id_tecnico, id_servicio, id_equipo, dir_asistencia,dir_destino, dir_mapa, distancia_mapa, tiempo_mapa, tarifa, costo,excedente, custodia, costo_total, estado_cuenta,fecha_ini, fecha_fin, t_inactivo, t_servicio, t_efectivo, observaciones, hora_ini, hora_fin) VALUES ('$id_cliente','$id_solicitante','$id_tecnico','$id_tipo_servicio','$id_equipo','$direccion_asistencia','$direccion_destino','$mapa_direc','$mapa_dist','$mapa_tiempo','$tarifa','$costo','$excedente','$custodia','$costo_total','$id_estado_cuenta','$fecha_hora_ini','$fecha_hora_fin','$tiempo_perdido','$tiempo_servicio','$tiempo_efectivo','$observaciones','$hora_ini','$hora_fin');");
            break;
            case 'update':
                $sql = $conn->prepare("UPDATE orden_servicio SET id_cliente='$id_cliente' WHERE id ='$id' ;");
            break;
        }
        //DEVUELDE DATOS AL JAVASCRIT
        if ($sql->execute()) { 
            echo ("exito");
        }else{
            echo "No se puede registar el dato";
        }
        $conn = null; // terminar la coneccion
        $sql = null; // terminar la coneccion
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
    
?>