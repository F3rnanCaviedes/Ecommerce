<?php

class ControllerForms{
	
//REGISTRAR NUEVO USUARIO
	static public function CtrlRegister(){

			 if(isset($_POST["name"])){
			 	$datatable = "usuario";
			 			//DATO EN TABLA MYSQL - DATO EN HTML NAME
			 	$data = array(
			 				"nombres" => $_POST["name"],
			 				"apellidos" => $_POST["lastname"],
			 				"phone" => $_POST["phone"],
			 				"estado" => $_POST["estate"],
			 				"correo" => $_POST["email"],
			 				"password" => $_POST["passname"],
			 				"idTipoUsuario" => $_POST["userType"],
			 				"fecha_nacimiento" => $_POST["dategrow"],
							"sex_gender" => $_POST["Sex"],
							//"fecha_ingreso" => $_POST["signinDate"]);
							);
			 	
			 	$sendata = ModelForms::mdlRegister($datatable, $data);
			 	return $sendata;
		 }

	}


//======FUNCION PARA INICIO DE SESION USUARIO=====
 public function CtrlControllerLogin(){
	if(isset($_POST["email"])){
		$datatable = "usuario";
		$datauser = "correo";
		$datainsert = $_POST["email"];


		$response = ModelForms::mdlSelectLogin($datatable, $datauser, $datainsert);

		if(is_array($response)){
		if($response["correo"] == $_POST["email"] && $response["password"] == $_POST["enterpassname"]){
			$_SESSION['loginUser'] = $response['correo'];

			echo '<div class="alert alert-success">Nos alegra verte de nuevo</div>;
	          <script>
	                window.location.replace("Index.php?action=Users");
	          </script';
		}else{
			echo '<script>
                    function NotReplicate(){
                          if(window.history.replaceState(){
                            window.history.replaceState(form, null, window.location.href);
                          }
                        }
                </script>';
             echo '<div class="alert alert-danger">Error al ingresar al sistema, el correo o la contraseña no coinciden</div>';
		}
	  }else{
	  		echo '<div class="alert alert-danger">Error al ingresar al sistema, el correo o la contraseña no coinciden</div>';
	 		 }
	}
}

			//FUNCION PARA LEER DATOS DE USUARIO		
	 public function ControllerUserLogin(){
		if(isset($_SESSION['loginUser'])){
			$datatable = "usuario";
			$datauser = "correo";
			$datainsert = $_SESSION['loginUser'];

			$response = ModelForms::mdlSelectLogin($datatable, $datauser, $datainsert);
			$_SESSION['userName'] = $response['nombres'];
			$_SESSION['userLastname'] = $response['apellidos'];
			$_SESSION['userAge'] = $response['fecha_nacimiento'];
			$_SESSION['userPhone'] = $response['phone'];
			$_SESSION['userId'] = $response['idUsuario'];
			$_SESSION['userType'] = $response['idTipoUsuario'];
			$_SESSION['photography'] = $response['photo'];
			$_SESSION['password'] = $response['password'];
			$_SESSION['direc1'] = $response['dir1'];
			$_SESSION['direc2'] = $response['dir2'];			
	}
}



//MOSTRAR ESTANTERIA DE PRODUCTOS
	 public function ControllerCollection($inf){
		if(isset($inf)){
		$mostrador = array();
	 	$datatable = "productos";

	$dataprod = 0;
        switch ($inf) {
      case 'Camibusos': $dataprod = 2;
        break;
      case 'Camisetas': $dataprod = 3;
        break;
      case 'Camisas': $dataprod = 1;
        break;
      case 'Camisillas': $dataprod = 4;
      default:
           $dataprod = 0;
        break;
    }

		$response = ModelForms::mdlSelectShop($datatable, $dataprod);

		foreach ($response as $key => $value) {
			  $mostrador["id_producto"] = $value["id_producto"];
        $mostrador["descripcion_producto"] = $value["descripcion_producto"];
        $mostrador["detalle_producto"] = $value["detalle_producto"];
        $mostrador["cantidad_producto"] = $value["cantidad_producto"];
        $mostrador["precio_producto"] = $value["precio_producto"];        
        $mostrador["file_producto"] = $value["file_producto"]; 

        $respuesta = ModelForms::mdlSelectType($dataprod);
        $resultado = $respuesta["producto"];
        $mostrador["tipo_producto"] = $resultado;

        $contador =  $value["coleccion"];
        $response = ModelForms::mdlSelectCollection($contador);
      	$result = $response["nombre_coleccion"];
        $mostrador["coleccion"] = $result; 

      echo  '<div class="col-md-4 col-lg-3 col-sm-6">
  <div class="card">
  <img class="card-img-top" src="PhotoBase/Products/' .$mostrador["tipo_producto"].'/'.$mostrador["coleccion"].'/'.$mostrador["file_producto"].'" id="myImg" alt="Card image" data-bs-toggle="modal" data-bs-target="#myModal'. $mostrador["id_producto"] .'"/>
  <div class="card-body">
    <h5 class="card-title" id="description" ></h5>
    <b><pre class="card-text">
    Color: ' . $mostrador["descripcion_producto"] . '
    Detalle: ' . $mostrador["detalle_producto"] .'
    Material: Algodón
    Precio: $'. $mostrador["precio_producto"] . '</pre>	</b>
    <input type="hidden" id="ProductCount" value="1">
    <input type="hidden" id="routeProduct" value="'.$inf.'"></pre>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center" style="border: solid black 1px;">
                  <input type="radio" name="color_option" value="S" id="color_option" autocomplete="off">
                  <span class="text-l">S</span>
                </label>
                <label class="btn btn-default text-center" style="border: solid black 1px;">
                  <input type="radio" name="color_option" value="M" id="color_option" autocomplete="off">
                  <span class="text-l">M</span>
                </label>
                <label class="btn btn-default text-center" style="border: solid black 1px;">
                  <input type="radio" name="color_option" value="L" id="color_option" autocomplete="off">
                  <span class="text-l">L</span>
                </label>
                <label class="btn btn-default text-center" style="border: solid black 1px;">
                  <input type="radio" name="color_option" value="XL" id="color_option" autocomplete="off">
                  <span class="text-l">XL</span>
                </label>
              </div><br/><br/>
    <button name="boton" id="getIt" class="btn btn-primary" data-name="'.$mostrador["descripcion_producto"].'" data-price="'.$mostrador["precio_producto"].'" data-photo="PhotoBase/Products/' .$mostrador["tipo_producto"].'/'.$mostrador["coleccion"].'/'.$mostrador["file_producto"].'" idProd="'. $mostrador["id_producto"] .'">
    Lo quiero ✓</button>
    <button name="boton" id="see" class="btn btn-success"><a id="selector" style="list-style: none; color: white;" href="Index.php?action=DetailShop&Typeproduct='.$inf.'&Data='. $mostrador["id_producto"].'"><i class="fa fa-eye">&nbsp;Ir</i></a></button>
  </div>
</div>
</div>


<div class="modal" id="myModal'. $mostrador["id_producto"] .'">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-black">

      <!--Modal Header boton cerrar modal-->
      <div class="modal-header">
        <button type="button" class="close btn-close bg-white" data-bs-dismiss="modal"></button>
      </div>

       <!--Modal body-->
      <div class="modal-body" style="padding: 0%;">
        <a id="link" href="PhotoBase/Products/' .$mostrador["tipo_producto"].'/'.$mostrador["coleccion"].'/'.$mostrador["file_producto"].'">
        	<img src="PhotoBase/Products/' .$mostrador["tipo_producto"].'/'.$mostrador["coleccion"].'/'.$mostrador["file_producto"].'" id="img01"/>
        </a>
      </div>
    </div>
  </div>
</div>';
			}
		}else{
			echo "ERROR EN EL CARGUE DE INFORMACIÓN, POR FAVOR INTENTELO MÁS TARDE";
		}
	}


//==========MOSTRAR DATOS PARA DETALLE COMPRA============
	static public function ControllerDetailShop($dato, $type){
					$database = 'productos';
					$dataprod = 0;
        switch ($type) {
		      case 'Camibusos': $dataprod = 2;
		        break;
		      case 'Camisetas': $dataprod = 3;
		        break;
		      case 'Camisas': $dataprod = 1;
		        break;
		      case 'Camisillas': $dataprod = 4;
		      default:
		           $dataprod = 0;
		        break;
		    }

					$confirmacion = ModelForms::mdlWhiteList($database, $dataprod, $dato);
					
					if(isset($dato) && $confirmacion == "ok"){
						$respuesta = ModelForms::mdlSelectproduct($database, $dato);
						return $respuesta;
				}else{
					echo '<script>window.location.replace("Index.php?action=Error404")</script>';
				}

	}


	//MOSTRAR DATOS EN CARRITO DE PRODUCTO PARA COMPRA
	public function ControllerSearch($busca){

		$response = ModelForms::mdlSearching();

    if (isset($busca)) {
       $response .= 'WHERE tipo_producto LIKE "%' . $busca . '%" ';
       $response .= 'OR descripcion_producto LIKE "%' . $busca . '%" ';
    }
	}


	//========MOSTRAR COMENTARIOS======
	static public function ctrlComments($producto){
		$datatable = "rating";
		$datatable2 = "usuario";
		$buscador = array();
		if(isset($producto)){
		$response = ModelForms::mdlComments($datatable, $producto);
		foreach ($response as $key => $value) {
			$buscadorUser = $value["idUsuario"];
			$userResponse = ModelForms::mdlSearchUser($datatable2, $buscadorUser);
			$buscador["idUsuario"] = $userResponse["nombres"] ." ". $userResponse["apellidos"];
			$buscador["photo"] = 'PhotoBase/Users/' . $userResponse['photo'];
			$buscador["idComment"] = $value["idComment"];
			$buscador["commentDate"] = $value["commentDate"];
							if($buscador["idComment"] != ""){
			                 echo 
			                 '<br><br>
			                 <div class="col-12 col-sm-8" style="border: solid gray 1px;">
			                 		<div class="post">
			                 				<div class="user-block">
			                 						<img src="'. $buscador["photo"] .'" width="52" height="52" class="rounded-circle" >
			                 						<b><span class="username"><p style="float: left">' . $buscador["idUsuario"] . '</p></span><i class="fas fa-heart" style="float: right; font-size: 25px"></i></b>
			                 				</div>
                    <p style="font-size: 16px;">' . $buscador["idComment"] . '</p><br/>
                    <h6 style="float: right">Publicado el '. $buscador["commentDate"] .'</h6>
                   		</div>
                   	</div><br/>';
                 }
           }
		}
	}


	//======BUSCAR CALIFICATION DE USUARIO============
	static public function ctrlCalification($idUsuario, $dato){
			$datatable = "rating";
			$verified = ModelForms::mdlCalification($datatable, $idUsuario, $dato);
			foreach ($verified as $key => $value) {
				$verifiedValue = $value["calification"];
				if($verifiedValue == 0 || $verifiedValue == ""){
					//echo $verifiedValue;
					return true;
			}else{
				return $verifiedValue;
			}

			}

	}


	 
}

?>