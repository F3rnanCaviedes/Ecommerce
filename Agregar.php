<?php
require("Conexion.php");
include("funciones.php");


                                  $imgFile = $_FILES['image']['name'];
                                  $tmp_dir = $_FILES['image']['tmp_name'];
                                  $imgSize = $_FILES['image']['size'];
                                  //$upload_dir = '../Photobase/Products/'; // upload directory
                                   $recaudo = $_POST['coleccion'];
                                    if ($recaudo != "") {                                       
                                  $stmt = Conexion::ConexionDB()->prepare("SELECT nombre_coleccion FROM coleccion WHERE id_coleccion = $recaudo");
                                          $stmt->execute();
                                          $response = $stmt->fetch();
                                          foreach ($response as $key) {
                                          switch ($_POST['tipo']) {
                                    case '1':
                                         $upload_dir = '../PhotoBase/Products/Camisa/' .$response["nombre_coleccion"]. '/' ;
                                        break;
                                    case '2':
                                         $upload_dir = '../PhotoBase/Products/Camibuso/' .$response["nombre_coleccion"]. '/';
                                        break;
                                    case '3':
                                         $upload_dir = '../PhotoBase/Products/Camiseta/' .$response["nombre_coleccion"]. '/';
                                        break;    
                                    case '4':
                                         $upload_dir = '../PhotoBase/Products/Camisilla/' .$response["nombre_coleccion"]. '/';
                                        break;

                                        default:
                                            $upload_dir = '../Photobase/Products/';
                                        break;
                                     }
                                    }
                                }
                                
                                 
                                   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
 
                                  
                                   // valid image extensions
                                   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                                  
                                   // rename uploading image
                                   $productpic = rand(1000,1000000).".".$imgExt;
                                    
                                   // allow valid image file formats
                                   if(in_array($imgExt, $valid_extensions)){   
                                    // Check file size '5MB'
                                    if($imgSize < 5000000)    {
                                     move_uploaded_file($tmp_dir,$upload_dir.$productpic);
                                    }
                                    else{
                                     $errMSG = "Lo sentimos, tu imagen es demasiado pesada, max 5MB.";
                                    }
                                }
                                   else{
                                    $errMSG = "Lo sentimos, solo se permiten formatos JPG, JPEG, PNG & GIF";  
                                   }
                                  

if ($_POST["operacion"] == "Agregar") {
            $response = ($_FILES['image'] != "") ? $productpic : NULL;
        $stmt = Conexion::ConexionDB()->prepare("INSERT INTO productos(                     
                             tipo_producto,
                             descripcion_producto,
                             detalle_producto,
                             cantidad_producto,   
                             precio_producto,
                             coleccion,
                             file_producto,
                             estado
                            )
                     VALUES (
                             :tipo_producto,
                             :descripcion_producto,
                             :detalle_producto,
                             :cantidad_producto,   
                             :precio_producto,
                             :coleccion,
                             :file_producto,
                             :estado
                            )");

        $resultado = $stmt->execute(
            array(
                        ':tipo_producto'    => $_POST["tipo"], 
                        ':coleccion'    => $_POST["coleccion"],
                        ':descripcion_producto' => $_POST["description"],
                        ':detalle_producto' => $_POST["detail"],                          
                        ':cantidad_producto'    => $_POST["amount"],
                        ':precio_producto'  => $_POST["price"],
                        ':file_producto'   => $response,
                        ':estado' => $_POST['state']
                        //':estado' => $_POST['state']
                    )
                );

        if (!empty($resultado)) {
            echo 'Producto agregado exitosamente';
        }   

}

if ($_POST["operacion"] == "Editar") {
                    //PERMANENCIA DE IMAGEN CUANDO NO SE MODIFICA
                    $staticImg = $_POST["idProduct"];
                    $stmt = Conexion::ConexionDB()->prepare("SELECT file_producto FROM productos WHERE id_producto = $staticImg");
                    $stmt->execute();
                    $consulta = $stmt->fetch();
                    $queryConsulta = $consulta['file_producto'];
                 $response = ($_FILES['image']['name'] == "" && $_FILES['image']['error'] == 4) ? $queryConsulta : $productpic;
                 //FIN

        $stmt = Conexion::ConexionDB()->prepare("UPDATE productos SET tipo_producto=:tipo_producto,
                            coleccion=:coleccion,
                            descripcion_producto=:descripcion_producto,
                            detalle_producto=:detalle_producto,
                            cantidad_producto=:cantidad_producto,
                            precio_producto=:precio_producto,
                            file_producto=:file_producto,
                            estado=:estado
                            WHERE id_producto = :id_producto");  
    
        $resultado = $stmt->execute(
            array(
                        ':tipo_producto'=> $_POST["tipo"], 
                        ':coleccion'=> $_POST["coleccion"],
                        ':descripcion_producto'=> $_POST["description"],
                        ':detalle_producto'=> $_POST["detail"],                          
                        ':cantidad_producto'=> $_POST["amount"],
                        ':precio_producto'=> $_POST["price"], 
                        ':file_producto'    => $response,
                        ':estado' => $_POST['state'],
                        ':id_producto' => $_POST["idProduct"])           
            );
        

        if (!empty($resultado)) {
            echo 'Registro actualizado exitosamente';
        }
    
   
}

?>