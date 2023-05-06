<!DOCTYPE html PUBLIC "-//W3C//DTD xhtml 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xtml1-transitional.dtd">
<html xmlns="http://www.w3c.org/1999/xhmtl" lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" type="text/html" charset="utf-8">
<title>Cavedi Rossi</title>
<link type="text/css" rel="Stylesheet" href="vista/modules/css/products.css" media="all"/>
</head>
<body>
<div class="row">
<div class="col-md-6">
    <div class="dropdown dropend bg-black">
      <input type="hidden" name="tipo" id="tipo" value="2"> 
    <button type="button" id="album" class="dropdown-toggle" data-bs-toggle="dropdown">
      <input type="button" id="album" name="btnColec" class="bg-black" style="height: 45px; color: white;" value="Colecciones">
    </button>
  <select class="dropdown-menu bg-black colec" id="list" name="list" style="width: 200px; height: 80px; font-family: monospace; color: white;">
    </select>
  </div>
</div>

<!--IMAGEN CLASIFICADORA-->
<div class="col-md-6" style="float: right;">
<img style="float: right;" id="fondo" src="PhotoBase/Mark/clase2.jpg"/>
</div>
</div>
<br/>
   <p id="texto">
     Selecciona tus compras ✔
  </p>
</br></br>
  <div class="row" id="showing">
    <?php
    //$variable = $_GET['list'];  
    //echo $variable;
      $inf = $_GET['action'];     
     $enviar = new ControllerForms();
     $enviar -> ControllerCollection($inf);
    ?>
  <br/><br/>
  <center><a href="Index.php?action=CheckoutBuy" id="btn" class="btn btn-primary">Continuar&nbsp;<i class="fa fa-solid fa-cart-plus"></i></a></center>
 </div>
</br></br></br>
</body>
<footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="vista/modules/js/CartShop.js"></script>
</footer>
</html>