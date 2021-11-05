<?php

	class Conexion extends PDO
	{
		private $hostBd = 'localhost';
		private $nombreBd = 'sysbuggys';
		private $usuarioBd = 'postgres';
		private $passwordBd = 'postgres';
	
		public function __construct()
		{
			try{
             	parent::__construct('pgsql:host=' . $this->hostBd . ';port=5432;dbname=' . $this->nombreBd, $this->usuarioBd, $this->passwordBd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				
				} catch(PDOException $e){
				echo 'Error: hola' . $e->getMessage();
				exit;
			}
		}
	}
?>