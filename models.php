<?php
class navegacionPaginas{
		
		public static function navegacionModels($linkModels){
			//Verifica el parametro para redireccioar la pagina
			if($linkModels == "Promociones" || $linkModels == "Registro" || 
				$linkModels == "Diseño" || $linkModels == "Trends" || $linkModels == "Gift"
				 || $linkModels == "Login" || $linkModels == "Camibusos"
				 || $linkModels == "Camisetas" || $linkModels == "Camisas" || $linkModels == "Camisillas" || $linkModels == "CheckoutBuy" || $linkModels == "Users" || $linkModels == "Salir" || $linkModels == "Stock" || $linkModels == "Colections" || $linkModels == "DetailShop" || $linkModels == "About" || $linkModels == "Fundamentals" || $linkModels == "Compras"){
				
				 $guide = "vista/modules/" .$linkModels. ".php";	
	   		}//-------verifica si está en pagina principal, y redirige a inicio----
	   		else if($linkModels == "Inicio" || $linkModels == "Index"){
	   			 $guide = "vista/modules/Inicio.php";
	   		}else{
	   			$guide = "vista/modules/Error404.php";
	   		}
	   	return $guide;
		}
	}

?>