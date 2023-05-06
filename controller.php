<?php
	class MvcController{
		
	#-------Llamar a la página principal-------
		public function estructura(){
			include "vista/Structure.php";
		}
	
	#-------llamar a las páginas de navegación-------
		public function navegacionController(){
				if(isset($_GET["action"])){
					$linkControl = $_GET["action"];
				}elseif (isset($_GET["search"])) {
					$linkControl = $_GET["search"];
				}
				else{
					$linkControl = "Index.php";
				}
				
			
			$access = navegacionPaginas::navegacionModels($linkControl);
			
			include $access;
			}
	}
	
?>