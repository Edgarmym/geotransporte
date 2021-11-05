<?php
	/*
		Web Service RESTful en PHP con MySQL (CRUD)
	*/
	include 'conexion.php';
	
	$pdo = new Conexion();
	
    //caso de prueba
    $sql = "INSERT INTO orden_servicio (id_cliente, id_vehiculo, id_aseguradora) VALUES(:id_cliente,:id_vehiculo,:id_aseguradora)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_cliente', $_POST['cliente']);
		$stmt->bindValue(':id_vehiculo', $_POST['vehiculo']);
		$stmt->bindValue(':id_aseguradora', $_POST['aseguradora']); 
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 

    $sql = $pdo->prepare("SELECT * FROM orden_servicio");
			$sql->execute();
     $datos = $sql->fetchAll();
     var_dump($datos) ;      
	//Listar registros y consultar registro


	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id']))
		{
			$sql = $pdo->prepare("SELECT * FROM orden_servicio WHERE id=:id");
			$sql->bindValue(':id', $_GET['id']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM orden_servicio");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}
	
	//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO orden_servicio (id_cliente, id_vehiculo, id_aseguradora) VALUES(:cliente, :vehiculo, :email)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_cliente', $_POST['nombre']);
		$stmt->bindValue(':id_vehiculo', $_POST['telefono']);
		$stmt->bindValue(':id_aseguradora', $_POST['email']);
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("HTTP/1.1 200 Ok");
			echo json_encode($idPost);
			exit;
		}
	}
	
	//Actualizar registro
	if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		$sql = "UPDATE orden_servicio SET id_cliente=:cliente, id_vehiculo=:vehiculo,tarifa=:tarifa, estado_cuenta=:estado_cuenta WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':cliente', $_GET['cliente']);
		$stmt->bindValue(':vehiculo', $_GET['vehiculo']);
		$stmt->bindValue(':tarifa', $_GET['tarifa']);
		$stmt->bindValue(':estado_cuenta', $_GET['estado_cuenta']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM orden_servicio WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_GET['id_orden_servicio']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");
?>