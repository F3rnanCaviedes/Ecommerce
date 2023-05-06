<?php

require_once "Conexion.php";
include("funciones.php");

if (isset($_POST["idProduct"])) {
    $salida = array();
    $stmt = Conexion::ConexionDB()->prepare("SELECT id_producto,
             tipo_producto,
             descripcion_producto,
             detalle_producto,
             cantidad_producto,   
             precio_producto,
             coleccion,
             file_producto
        FROM productos WHERE id_producto = '".$_POST["idProduct"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();


    foreach($resultado as $fila){

            // OBTENER TIPO DE PRODUCTO POR NOMBRE
        $contadores =  $fila["tipo_producto"];
        $stmt = Conexion::ConexionDB()->prepare("SELECT producto FROM tipoproducto WHERE Id_TipoProducto = $contadores");
        $stmt->execute();
        $responses = $stmt->fetch();
        $resul = $responses["producto"]; 
        $sub_array[] = $resul;
       // OBTENER NOMBRE DE COLECCION
        $contador =  $fila["coleccion"];
        $stmt = Conexion::ConexionDB()->prepare("SELECT nombre_coleccion FROM coleccion WHERE id_coleccion = $contador");
        $stmt->execute();
        $response = $stmt->fetch();
       $result = $response["nombre_coleccion"];



        $ruta = 'PhotoBase/Products/' .$resul. '/' .$result. '/';

        $salida["id_producto"] = $fila["id_producto"];
        $salida["tipo_producto"] = $fila["tipo_producto"];
        $salida["coleccion"] = $salida;
        $salida["descripcion_producto"] = $fila["descripcion_producto"];
        $salida["detalle_producto"] = $fila["detalle_producto"];
        $salida["cantidad_producto"] = $fila["cantidad_producto"];
        $salida["precio_producto"] = $fila["precio_producto"];        
        $salida["file_producto"] = $fila["file_producto"];
        $salida["ruta"] = $ruta.$fila["file_producto"];    
        }

    echo json_encode($salida);
}

