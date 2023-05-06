<?php

    require_once "Conexion.php";
    include("funciones.php");

    $query = "";
    $salidPersona = array();
    $query = "SELECT
             id_producto,
             tipo_producto,
             descripcion_producto,
             detalle_producto,
             cantidad_producto,   
             precio_producto,
             coleccion,
             file_producto
        FROM productos WHERE 1=1;";

    if (isset($_POST["search"]["value"])) {
       $query .= 'WHERE descripcion_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
       $query .= 'OR detalle_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';        
    }else{
        $query .= 'ORDER BY id_producto DESC ';
    }

    if($_POST["length"] != -1){
       $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    }


     $stmt = Conexion::ConexionDB()->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
        $salidPersona = array();
    foreach($resultado as $fila){
      
        $sub_array = array();
        $sub_array[] = $fila["id_producto"];
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
        $sub_array[] = $result;
        $sub_array[] = $fila["descripcion_producto"];
        $sub_array[] = $fila["detalle_producto"];
        $sub_array[] = $fila["cantidad_producto"];            
        $sub_array[] = $fila["precio_producto"];
        $sub_array[] = '<img src="PhotoBase/Products/' .$resul. '/' .$result. '/' .$fila["file_producto"]. '" style="width: 80px; height: 80px;">';        
            
        $sub_array[] = '<button type="button" id="editar" name="editar" idProduct="'.$fila["id_producto"].'" class="btn btn-warning btn-xs editar"><i class="fa fa-pencil-alt"></i></button><button type="button" name="borrar" idProduct="'.$fila["id_producto"].'" class="btn btn-danger btn-xs borrar"><i class="fa fa-trash-alt"></i></button>';
        $datos[] = $sub_array;
    }

    $salidPersona = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos
    );

    echo json_encode($salidPersona);
    