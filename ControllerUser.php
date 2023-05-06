<?php 

require("../modelo/Conexion.php");

											 $imgFile = $_FILES['photography']['name'];
                                  $tmp_dir = $_FILES['photography']['tmp_name'];
                                  $imgSize = $_FILES['photography']['size'];

                                  $upload_dir = '../Photobase/Users/';

                                  $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
 
                                  
                                   // valid image extensions
                                   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                                  
                                   // rename uploading image
                                   $userpic = rand(1000,1000000).".".$imgExt;
                                    
                                   // allow valid image file formats
                                   if(in_array($imgExt, $valid_extensions)){   
                                    // Check file size '5MB'
                                    if($imgSize < 5000000)    {
                                     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                                    }
                                    else{
                                     $errMSG = "Lo sentimos, tu imagen es demasiado pesada, max 5MB.";
                                    }
                                }
                                   else{
                                    $errMSG = "Lo sentimos, solo se permiten formatos JPG, JPEG, PNG & GIF";  
                                   }
                        

                     if($_POST['action'] == "guardar"){
                     // && $_POST['names'] != "" && $_POST['lastnames'] != ""){
								$datatable = "usuario";
								$datainsert = $_POST['idUser'];
								print_r($datainsert);

								//COMPROBACION DE IMAGEN DE USUARIO
                    $static = $_POST["UserId"];
                    $stmt = Conexion::ConexionDB()->prepare("SELECT photo FROM $datatable WHERE idUsuario = $static");
                    $stmt->execute();
                    $consulta = $stmt->fetch();
                    $queryConsulta = $consulta['photo'];
               	   $response = ($_FILES['photography']['name'] == "" && $_FILES['photography']['error'] == 4) ? $queryConsulta : $userpic;
               	   $stmt = null;
                 //FIN

               	    //COMPROBACION DE CAMBIO DE CONTRASEÑA
               	    $p1 = $_POST['password1']; $p2 = $_POST['password2'];
               	     if(isset($p1) && $p1 == $p2){ 
               	     		$clave = $p1; 
               	     	}elseif(!isset($p1) && !isset($p2)){
               	     	 $clave = $_POST['passUser'];
               	     }
               	   	

			$data = array(
			 				"nombres" => $_POST["names"],
			 				"apellidos" => $_POST["lastname"],
			 				"fecha_nacimiento" => $_POST["borndate"],
			 				"phone" => $_POST["phone"],
			 				"password" => $clave,
			 				"dir1" => $_POST["direc1"],
			 				"dir2" => $_POST["direc2"],
			 				"photo" => $response
							);

			      $stmt = Conexion::ConexionDB()->prepare("UPDATE $datatable SET						
							nombres=:nombres,
			 				apellidos=:apellidos,
			 				phone=:phone,
			 				fecha_nacimiento=:fecha_nacimiento,
							dir1=:dir1,
							dir2=:dir2,
							photo=:photo WHERE idUsuario = $static");

        		$stmt -> bindParam(":nombres", $data["nombres"], PDO::PARAM_STR);
				$stmt -> bindParam(":apellidos", $data["apellidos"], PDO::PARAM_STR);
				$stmt -> bindParam(":fecha_nacimiento", $data["fecha_nacimiento"], PDO::PARAM_STR);
				$stmt -> bindParam(":phone", $data["phone"], PDO::PARAM_STR);
				if($_POST['controlPass']=="allow"){
					$stmt = Conexion::ConexionDB()->prepare("UPDATE $datatable SET password=:password");
					$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
				}
				$stmt -> bindParam(":dir1", $data["dir1"], PDO::PARAM_STR);
				$stmt -> bindParam(":dir2", $data["dir2"], PDO::PARAM_STR);
				$stmt -> bindParam(":photo", $data["photo"], PDO::PARAM_LOB);
    
        $resultado = $stmt->execute();

				// VACIAR LA DATA Y CERRAR CONEXION EN CASO DE ERROR
				$stmt = NULL;

			if (!empty($resultado)) {
				    //echo '<script type="text/javascript"> alert("Información actualizada exitosamente");</script>';
				echo "Información actualizada exitosamente";
			}else{
				//echo '<script type="text/javascript">alert("error en guardado, por favor intentelo de nuevo");</script>';
				echo "error en guardado, por favor intentelo de nuevo";
			}

		}