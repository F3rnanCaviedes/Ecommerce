	<?php

 	require_once "Conexion.php";

	class ModelForms{

	static public function mdlRegister($datatable, $data){



				//PREPARE: UNA FUNCION QUE PREPARA UNA SENTENCIA SQL PARA SER EJECUTADA POR EL METODO PDO:STATEMENT EXECUTE. DATOS PARA CONEXION MYSQL CON TERMINOS SQL - LOS : SIGNIFICAN PARAMETRO OCULTO
				$stmt = Conexion::ConexionDB()->prepare("INSERT INTO $datatable(						
							nombres,
			 				apellidos,
			 				phone,
			 				estado,
			 				correo,
			 				password,
			 				idTipoUsuario,
			 				fecha_nacimiento,
							sex_gender
							)
					 VALUES (
					 		:nombres,
			 				:apellidos,
			 				:phone,
			 				:estado,
			 				:correo,
			 				:password,
			 				:idTipoUsuario,
			 				:fecha_nacimiento,
							:sex_gender
							)");
				#LA CLASE BINDPARAM PERMITE ENLAZAR UN DATO SQL A UNA VARIABLE PHP - PDO ES LA CLASE PARA INTERACTUAR CON CONEXIONES SQL EN PHP... LOS PARÁMETROS DE BINDPARAM SON (OBJETO OCULTO, DATO DEL QUE VOY A TRAER LA INFORMACION Y EL TIPO DE DATO) 
				//$stmt -> bindParam(":idUsuario", $data["userID"], PDO::PARAM_STR);
					//VALOR DEL MYSQL - VALOR TITULO DE LA VARIABLE SEGÚN EL CONTROLLERFORMS - TIPO DE DATOS 
				$stmt -> bindParam(":nombres", $data["nombres"], PDO::PARAM_STR);
				$stmt -> bindParam(":apellidos", $data["apellidos"], PDO::PARAM_STR);
				$stmt -> bindParam(":phone", $data["phone"], PDO::PARAM_STR);
				$stmt -> bindParam(":estado", $data["estado"], PDO::PARAM_BOOL);
				$correoIn = strtolower($data["correo"]);
				$stmt -> bindParam(":correo", $correoIn, PDO::PARAM_STR);
				$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
				$stmt -> bindParam(":idTipoUsuario", $data["idTipoUsuario"], PDO::PARAM_INT);
				$stmt -> bindParam(":fecha_nacimiento", $data["fecha_nacimiento"], PDO::PARAM_STR);
				$sexo = ($_POST["Sex"]  == "Masculino") ? 'M' : 'F';
				$stmt -> bindParam(":sex_gender", $sexo, PDO::PARAM_STR);
				//$stmt -> bindParam(":fecha_ingreso", $data["signinDate"], PDO::PARAM_STR);

				if($stmt->execute()){
					$stmt = "ok";
					return $stmt;
				}else{
					print_r(Conexion::ConexionDB()->errorInfo());
				}

				//CERRAR CONEXION DE LA BASE DE DATOS
				$stmt -> close();

				// VACIAR LA DATA EN CASO DE ERROR
				$stmt = NULL;

		}



		//SELECCIONAR SOLO 2 DATOS DE USUARIO
	 static public function mdlSelectLogin($datatable, $datauser, $datainsert){

				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE $datauser = :$datauser ORDER BY idUsuario DESC");
				$stmt -> bindParam(":".$datauser, $datainsert, PDO::PARAM_STR);
				$stmt -> execute();

				//FETCH: DEVUELVE 1 REGISTRO DE LA BASE DE DATOS ---- FETCH(): DEVUELVE UN REGISTRO DE LA BASE DE DATOS
				return $stmt -> fetch();
				$stmt -> close();
				$stmt = NULL;

		}

				//============EDITAR DATOS DE USUARIO==========
		static public function mdlEditUser($datatable, $data, $datainsert){


        $stmt = Conexion::ConexionDB()->prepare("UPDATE $datatable SET						
							nombres=:nombres,
			 				apellidos=:apellidos,
			 				phone=:phone,
			 				password=:password,
			 				fecha_nacimiento=:fecha_nacimiento,
							dir1=:dir1,
							dir2=:dir2,
							photo=:photo
                            WHERE correo = $datainsert");
        		$stmt -> bindParam(":nombres", $data["nombres"], PDO::PARAM_STR);
				$stmt -> bindParam(":apellidos", $data["apellidos"], PDO::PARAM_STR);
				$stmt -> bindParam(":fecha_nacimiento", $data["fecha_nacimiento"], PDO::PARAM_STR);
				$stmt -> bindParam(":phone", $data["phone"], PDO::PARAM_STR);
				$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
				$stmt -> bindParam(":dir1", $data["dir1"], PDO::PARAM_STR);
				$stmt -> bindParam(":dir2", $data["dir2"], PDO::PARAM_STR);
				$stmt -> bindParam(":photo", $data["photo"], PDO::PARAM_BLOB);
    
        $resultado = $stmt->execute();
        //CERRAR CONEXION DE LA BASE DE DATOS
				$stmt -> close();

				// VACIAR LA DATA EN CASO DE ERROR
				$stmt = NULL;

       return $resultado;
		}
			



	//SELECCIONAR LISTA BLANCA PARA DetailShop	
	 static public function mdlWhiteList($database, $dato, $dataprod){
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $database WHERE tipo_producto = $dataprod  AND id_producto = $dato");
				$stmt -> execute();
				$base = $stmt->fetchAll();
				if(is_array($base)){
					$stmt = "ok";
					return $stmt;
				}else{
					echo "ERROR EN LA BÚSQUEDA, POR FAVOR VUELVA A INICIO O RETROCESA UNA PESTAÑA";
				}
			}


//SELECCIONA TODOS LOS PRODUCTOS
	static public function mdlSelectShop($datatable, $dataprod){
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE tipo_producto = $dataprod ORDER BY id_producto ASC");
				$stmt -> execute();
		        return $stmt->fetchAll(); 
		        $stmt -> close();
				$stmt = NULL;
				}

//SELECCIONA UN PRODUCTO
static public function mdlSelectproduct($datatable, $dato){
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE id_producto = $dato ORDER BY id_producto ASC");
				$stmt -> execute();
		        return $stmt->fetch(); 
		        $stmt -> close();
				$stmt = NULL;
				}

//SELECCIONA TIPO DE PRODUCTO
static public function mdlSelectType($dataprod){
				$stmt = Conexion::ConexionDB()->prepare("SELECT producto FROM tipoproducto WHERE Id_TipoProducto = $dataprod");
       			$stmt->execute();
		        return $stmt->fetch(); 
		        $stmt -> close();
				$stmt = NULL;
				}

//SELECCIONA TIPO DE COLECCION
static public function mdlSelectCollection($contador){
		        $stmt = Conexion::ConexionDB()->prepare("SELECT nombre_coleccion FROM coleccion WHERE id_coleccion = $contador");
		        $stmt->execute();
		        return $stmt->fetch(); 
		        $stmt -> close();
				$stmt = NULL;
				}

//BUSQUEDA INDIVIDUAL DE PRODUCTOS
static public function mdlSearching(){
		     $stmt = Conexion::ConexionDB()->prepare("SELECT
             id_producto,
             tipo_producto,
             descripcion_producto,
             detalle_producto,
             cantidad_producto,   
             precio_producto,
             coleccion,
             file_producto
        	 FROM productos WHERE 1=1;");
		        $stmt->execute();
		        return $stmt->fetch(); 
		        $stmt -> close();
				$stmt = NULL;
				}



			//BUSCAR PRODUCTO SEGÚN COLOR
				static public function mdlSelectColor($datatable, $type){
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
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE tipo_producto = $dataprod ORDER BY id_producto ASC");
				$stmt -> execute();
		        return $stmt->fetchAll(); 
		        $stmt -> close();
				$stmt = NULL;
				}


				//===========OBTENER COMENTARIOS DE PRODUCTOS DE RATING============
			static public function mdlComments($datatable, $producto){
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE id_producto = $producto ORDER BY commentDate DESC");
				$stmt -> execute();
				return $stmt -> fetchAll();
				$stmt -> close();
				$stmt = NULL;
			}


			//======================BUSCAR CALIFICATION DE ESTRELLAS ANTERIOR===============
			// ===================== busca en rating por usuario==============================
			static public function mdlCalification($datatable, $idUsuario, $dato){
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE idUsuario = $idUsuario AND id_producto = $dato ORDER BY commentDate DESC");
				$stmt -> execute();
				return $stmt -> fetchAll();
				$stmt -> close();
				$stmt = NULL;
			}


			//===========OBTENER DATOS INDIVIDUALES DE USUARIO============
			static public function mdlSearchUser($datatable2, $buscadorUser){
				$stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable2 WHERE idUsuario = $buscadorUser ORDER BY idUsuario DESC");
				$stmt -> execute();
				return $stmt -> fetch();
				$stmt -> close();
				$stmt = NULL;
			}

			static public function mdlSearchMailUser($datatable, $correo){
				$stmt = Conexion::ConexionDB()->prepare("SELECT correo FROM $datatable WHERE correo = '$correo' ORDER BY idUsuario DESC");
				$stmt -> execute();
				return $stmt -> fetch();
				$stmt -> close();
				$stmt = NULL;
			}


	/*static public function mdlGetCallAllProduct(){
        $stmt = Conexion::ConexionDB()->prepare("SELECT * FROM productos");
        $stmt->execute();
        $resultado = $stmt->fetchAll(); 
        return $stmt->rowCount();       
				$stmt -> close();
				$stmt = NULL;
			}

//OBTENER REGISTRO TOTAL DE PRODUCTOS
	static public function mdlGetAllProducts(){
			$query = "SELECT
             id_producto,
             tipo_producto,
             descripcion_producto,
             detalle_producto,
             cantidad_producto,   
             precio_producto,
             coleccion,
             file_producto
        FROM productos; ";

        if (isset($_POST["search"]["value"])) {
       $query .= 'WHERE tipo_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
       $query .= 'OR descripcion_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';        
    }else{
        $query .= 'ORDER BY id_producto DESC ';
    }

    //if($_POST["length"] != -1){
     //  $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
   //}

   	$stmt = Conexion::ConexionDB()->prepare($query);
    $stmt->execute();
    $filtered_rows = $stmt->rowCount();
    return $stmt->fetchAll();
	}*/

}
?>