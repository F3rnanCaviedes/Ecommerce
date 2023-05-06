<?php
	require_once "../modelo/Conexion.php";
	require_once "../modelo/ModelForms.php";

	if (isset($_REQUEST['email'])) {
		$datatable = "usuario";
		$correo = $_REQUEST['email'];
		$stmt = ModelForms::mdlSearchMailUser($datatable, $correo);
		if(isset($stmt['correo']) && strcasecmp($correo, $stmt['correo']) == 0){
			echo "<div id='error' class='alert alert-danger'><p>Este correo ya existe por favor intenta con uno diferente</p></div><script>document.getElementById('exito').style.display = 'none'</script>";
		}else if($stmt['correo'] == ""){
			echo "";
		}else{
			echo "<div class='alert alert-success'><p>Correo permitido </p></div><script>document.getElementById('error').style.display = 'none'</script>";

		}
	}

	/*if(!isset($_POST['photo'])){
		$datatable = "usuario";
		$photo = $_REQUEST['photo'];
		$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE photo = $photo ORDER BY idUsuario DESC");
		$stmt->execute();
		return $stmt -> fetch();
	}*/

?>