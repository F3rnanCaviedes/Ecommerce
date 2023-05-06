<?php

    function obtener_todos_registros(){
        require_once "Conexion.php";
        $stmt = Conexion::ConexionDB()->prepare("SELECT * FROM productos");
        $stmt->execute();
        $resultado = $stmt->fetchAll(); 
        return $stmt->rowCount();       
    }
    ?>