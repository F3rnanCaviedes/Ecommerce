	<?php
require("../modelo/Conexion.php");


        //============ LISTA DESPLEGABLE ==========
        //=======================================
        if (isset($_POST['tipo'])) {
            $data = $_POST['tipo'];
            $datatable = 'coleccion';
        $stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE tipo_producto = $data ORDER BY id_coleccion ASC");
                $stmt -> execute();
                $response = $stmt->fetchAll();
                echo '<option class="dropdown-item" style="font-family: monospace;" value="0">Escoge una colección</option>';
               foreach($response as $key => $val){
                   $salida = '<option class="dropdown-item" name="colec" style="font-family: monospace;" value="' . $val["id_coleccion"] . '"><a href="Index.php?action=Camisetas&list">' . $val["nombre_coleccion"] . '</a></option>';
                   echo $salida;
                }
            }else{
                echo "Error del sistema, intentalo más tarde o reportalo a tu desarrollador";
            }


            //SELECCIONAR PRODUCTOS PARA CARRITO
       $dato = $_POST['idProd'];
        if(isset($dato)){
        $database = 'productos';
                $stmt = Conexion::ConexionDB()->prepare("SELECT * FROM productos WHERE id_producto = $dato ORDER BY id_producto ASC");
                $stmt -> execute();
                $response = $stmt->fetch();


        echo '<tbody><tr><td>'.$response["id_producto"].'</td><td>'.$response["descripcion_producto"].'</td><td>'.$response["detalle_producto"].'</td><td>'.$response["precio_producto"].'</td><td><input type="number" name="cantidad" value="1" maxlength="2" style="width: 50%; float: left;"></td><td><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></td></tr></tbody>';
    }

            $existence = false;
        $productos = unserialize($_COOKIE['productos']);
        if (!is_array($productos)) {
            $productos = array();
        }
        foreach ($productos as $key => $value) {
            if ($value['idProd']==$_REQUEST['idProd']) {
                $productos[$key]["cantidad"]=$productos[$key]["cantidad"]+$_REQUEST['cantidad'];
                $existence = true;
            }
        }
        if ($existence == false) {
            array_push($productos, array(
                "idProd"=>$_REQUEST['idProd'],
                "name"=>$_REQUEST['name'],
                "cantidad"=>$_REQUEST['cantidad'],
                "photo"=>$_REQUEST['photo']
            )
        );

        }
        setcookie("productos", serialize($productos));
        echo json_encode($productos);



?>
