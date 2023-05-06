<?php
		
		$existence = false;
        $productos = unserialize($_COOKIE['productos']??'');
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
                "photo"=>$_REQUEST['photo'],
                "eye"=>$_REQUEST['eye'],
                "talla"=>$_REQUEST['talla']
            )
        );

        }
        setcookie("productos", serialize($productos));
        echo json_encode($productos);

?>