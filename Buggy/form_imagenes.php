<?php

$count = 0;

if ( !is_dir('./respaldos') ) mkdir('./respaldos');

$data = [];

include 'ws/conexion.php';
$pdo = new Conexion();
	
foreach ($_FILES as $key => $file) {

	$path_info = pathinfo( './respaldos/' .$file['name'] );
	$photo_name = str_random($path_info);

	//if ( !move_uploaded_file($file['tmp_name'], './respaldos/' .$photo_name) ) {
        if ( !move_uploaded_file($file['tmp_name'], './respaldos/' .$file['name']) ) {    
		return print_r( json_encode(['message' => 'No fue posible subir los archivos', 'status' => http_response_code(500)] ));
		}

//	array_push($data, [ 
//        'id' => $key, 
//        'file_name' => $photo_name ]);
	array_push($data, [ 
        'id' => $key, 
        'file_name' => $file['name'],
        'file_path' => $path_info]); 
        
         // $sql = "INSERT INTO fotografias (id_contingencia,descripcion, archivo)  
          //  VALUES(:idcontingencia,:descrip,:nombre)";
           $sql = "INSERT INTO fotografias (id_contingencia,descripcion,ruta,tipo_archivo,nombre_archivo
           ) VALUES(:idcontingencia,:descrip,:ruta,:tipo,:nombre)";
    
            $stmt = $pdo ->prepare($sql);
            $stmt->bindValue(':idcontingencia', 1);
            $stmt->bindValue(':descrip', "descripcion");
            $stmt->bindValue(':ruta', $path_info['dirname']);
            $stmt->bindValue(':tipo', $path_info['extension']);
            $stmt->bindValue(':nombre', $file['name']);
            
            $stmt->execute(); 
	$count++;

}

function str_random ($path_info) {
	$string = 'AaBbCcDdEeFfGgHhIiJjKkLlMm0123456789_';
	return str_shuffle($string). '.' .$path_info['extension'];
}

if ( $count == count( $_FILES ) ) {


	$message = ( $count > 1 ? 'Se subieron ' .$count. ' fotos con éxito' : 'Se subió ' .$count. ' foto con éxito' );

	return print_r(json_encode(
		[
			'message' => $message,
			'status' => http_response_code(200),
			$data
		]
	));
}