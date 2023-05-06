
<?php
require("Conexion.php");
include("funciones.php");


        //============ LISTA DESPLEGABLE ==========
        //=======================================
        if (isset($_POST['tipo'])) {
            $data = $_POST['tipo'];
            $datatable = 'coleccion';
            $stmt = Conexion::ConexionDB()->prepare("SELECT * FROM $datatable WHERE tipo_producto = $data ORDER BY id_coleccion ASC");
                $stmt -> execute();
                $response = $stmt->fetchAll();
                echo  '<option value="0">Escoge una coleccion</option>';
               foreach($response as $key => $val){
                   $salida = '<option value="' . $val["id_coleccion"] . '">' . $val["nombre_coleccion"] . '</option>';
                   echo $salida;
                }
            }else{
                echo "Error del sistema, intentalo más tarde o reportalo a tu desarrollador";
            }

?>