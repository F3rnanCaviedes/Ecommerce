<?php
	require_once "../modelo/Conexion.php";
	require_once "../modelo/ModelForms.php";

//DATO EN TABLA MYSQL - DATO EN HTML NAME

			 if($_REQUEST["idComment"] != "" || $_REQUEST["calification"] > 0){
			 	$datatable = "rating";
			 	$producto = $_REQUEST['id_producto'];
				$stmt = ModelForms::mdlComments($datatable, $producto);
				foreach ($response as $key => $value) {
					$convert += $value["calification"];
				}
			 			
			 	$data = array(
			 				"id_producto" => $_REQUEST["id_producto"],
			 				"idUsuario" => $_REQUEST["idUsuario"],
			 				"idComment" => $_REQUEST["idComment"],
			 				"calification" => $_REQUEST["calification"],
			 				"ratingCalification" => $convert,//$_REQUEST['ratingCalification'] . $convert,
			 				"sold" => $_REQUEST["sold"]
							);

			 	$stmt = Conexion::ConexionDB()->prepare("INSERT INTO $datatable(						
			 				id_producto,
			 				idUsuario,
			 				idComment,
			 				ratingCalification,
			 				calification,
			 				sold
							)
					 VALUES (
			 				:id_producto,
			 				:idUsuario,
			 				:idComment,
			 				:ratingCalification,
			 				:calification,
			 				:sold
							)");
							//$stmt -> bindParam(":id_place", PDO::PARAM_STR);
			 				$stmt -> bindParam(":id_producto", $data["id_producto"], PDO::PARAM_INT);
			 				$stmt -> bindParam(":idUsuario", $data["idUsuario"], PDO::PARAM_INT);	
			 				$stmt -> bindParam(":idComment", $data["idComment"], PDO::PARAM_STR);			 		
			 				$stmt -> bindParam(":ratingCalification", $data["ratingCalification"], PDO::PARAM_INT);
			 				$stmt -> bindParam(":calification", $data["calification"], PDO::PARAM_INT);
			 				$stmt -> bindParam(":sold", $data["sold"], PDO::PARAM_INT);

			 				$stmt->execute();
			 				return $stmt;

			 			}




?>