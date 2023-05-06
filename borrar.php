<?php

require_once "Conexion.php";
include("funciones.php");

if(isset($_POST["idProduct"]))
{
	
	$stmt = Conexion::ConexionDB()->prepare(
		"DELETE FROM productos WHERE id_producto = :id_producto"
	);
	$resultado = $stmt->execute(
		array(
			':id_producto'	=>	$_POST["idProduct"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Registro borrado';
	}else{
		echo 'Error, no se puede borrar! Existe una relación';
	}
}



?>