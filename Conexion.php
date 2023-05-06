<?php
	class Conexion{
		static public function ConexionDB(){
			$usuario = "Principal";
		    $password = "LokalHost3312";
		    $conexion = new PDO("mysql:host=127.0.0.1;dbname=ecommerce", $usuario, $password);

		    //INCLUIR CARACTERES LATINOS
		    $conexion->exec("set names utf8");
		    
		    //RETORNAR CONEXION
		    return $conexion;
		}

	}
