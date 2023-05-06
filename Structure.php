<?php session_start() ?>
<?php session_regenerate_id(true); ?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="Cavedi Rossi">
    <meta name="author" content="Férnan Caviedes">
    <title>Cavedi Rossi</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cheatsheet/">
    <link rel="icon" type="icon" href="icon.ico">
    <link rel="stylesheet" href="vista/modules/css/adminlte.min.css">

    <!--LIBRERIAS IONICONS
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css">-->

    <!--LIBRERIAS FONTAWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />   
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="vista/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="vista/Scructure.css" type="text/css" rel="stylesheet">	

    <!--INCRUSTAR FIGURAS SVG-->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="people-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      <symbol id="table" viewBox="0 0 16 16">
    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
  </symbol>
  </symbol>
  </svg>
	
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
  </head>

      <body class="bg-light">
	 <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start" >
        <a href="Index.php?action=Index" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="PhotoBase/Logo_img.jpg" class="bi me-2" width="50" height="50" role="img" aria-label="CavediRossi"></img>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="Index.php?action=Inicio" class="nav-link px-2 text-secondary">Inicio</a></li>
          <li><a href="Index.php?action=Trends" class="nav-link px-2 text-white">Tendencias</a></li>
          <li><a href="Index.php?action=Promociones" class="nav-link px-2 text-white">Promociones</a></li>
          <li><a href="Index.php?action=Gift" class="nav-link px-2 text-white">Premios</a></li>
        </ul>

          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="Index.php">
            <?php
              /*$con = mysqli_connect(Conexion::ConexionDB());
              $busca = mysqli_real_escape_string($con, $_REQUEST['search']??'');*/
              $busca = $_REQUEST['search']??'';
            ?>
          <input type="search" class="form-control" autocapitalize="sentences" placeholder="Buscar..." name="search" value="<?php echo $busca; ?>" aria-label="Search">
          <?php 
          $where = " WHERE 1=1 ";
          $busca1 = ucfirst($busca);
                  if (isset($busca1)) {
                       $where.= "AND descripcion_producto LIKE '%" .ucfirst($busca1). "%'";
                      // $where= 'OR detalle_producto LIKE "%' .$busca. '%" ';
                    }

           ?>
        </form>
        <div style="padding-right: 10px;">
                <a class="dropdown" data-bs-toggle="dropdown" id="ProdDown" href="#">
                <i class="fa fa-solid fa-cart-plus" style="color: white; font-size: 30px;"></i>
                      <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger" id="badgeProduct">
                        <span class="visually-hidden">Mis compras</span> 
                      </span>
                  </a>
                    <ul class="dropdown-menu list-unstyled dropdown-menu-lg dropdown-menu-right" id="CartList" aria-labelledby="ProdDown">
                      </ul>
        </div>

        <?php if(isset($_SESSION['loginUser'])): ?>
                    <button type="button" class="btn btn-info btn-outline-light me-2"><a  href="Index.php?action=Diseño" style="list-style: none; color: white;">Diseño</a></button>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
           <?php if(isset($_SESSION['photography'])): ?>
            <img src="<?php echo 'PhotoBase/Users/' . $_SESSION['photography']; ?>" id="photo" alt="mdo" width="52" height="52" class="rounded-circle" >
         <?php elseif(!isset($_SESSION['photography'])): ?>
           <i class="fa fa-user" style="color:  white;"></i>
          <?php endif ?>
          </a>

          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <?php if($_SESSION['userType'] == 1): ?>
            <li><a class="dropdown-item" href="Index.php?action=Stock">Inventario</a></li>
            <li><a class="dropdown-item" href="Index.php?action=Compras">Mis compras</a></li>
            <li><a class="dropdown-item" href="Index.php?action=Users">Mi perfil</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="Index.php?action=Salir">Salir</a></li>
            <?php else: ?>
            <li><a class="dropdown-item" href="Index.php?action=Compras">Mis compras</a></li>
            <li><a class="dropdown-item" href="Index.php?action=Users">Mi perfil</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="Index.php?action=Salir">Salir</a></li>
            <?php endif ?>
          </ul>
        </div>
      <?php elseif (!isset($_SESSION['loginUser'])): ?>
      <button type="button" class="btn btn-warning me-2"><a  href="Index.php?action=Registro" style="link-style: none; color: black;">Registrarse</a></button>
          <div id="inicio" class="text-end">
          <!--<button type="button" class="btn btn-outline-light me-2"><a  href="Index.php?action=Login" style="list-style: none; color: white;">Iniciar sesión</a></button>-->
                    <a href="Index.php?action=Login" class="btn btn-outline-dark me-2 text-white">
                <svg class="bi d-block mx-auto mb-1" fill="white" width="30" height="30"><use xlink:href="#people-circle"/></svg>
                Iniciar sesión
              </a>
        </div>
      <?php endif ?>
      </div>
    </div>
  </header>
  <?php if (isset($_GET['search'])) {
      $inf = $_GET['search']; 
    }else{
      $inf = $_GET['action'];
      } ?>
     <?php if(isset($inf)): ?>

    <?php if($inf == "Camibusos" || $inf == "Camisas" ||  $inf == "Camisetas" || $inf == "Camisillas" || $inf == "DetailShop" ): ?>
                        <!--SECCION DE ENCABEZADO PARA COLECCIONES-->
<section class="content-header">
  <div class="row justify-content-center d-flex flex-wrap align-items-center justify-content-lg-start" style="margin-top: -2%">
    <button class="col-md-3 bg-dark justify-content-center text-white"><h5><a href="Index.php?action=Camisas" class="option" value="camisas">Camisas</a></h5></button>
    <button class="col-md-3 bg-dark justify-content-center text-white"><h5><a href="Index.php?action=Camibusos" class="option" value="camibusos">Camibusos</a></h5></button>
    <button class="col-md-3 bg-dark justify-content-center text-white"><h5 ><a href="Index.php?action=Camisetas" class="option" value="camisetas">Camisetas</a></h5></button>
    <button class="col-md-3 bg-dark justify-content-center text-white"><h5><a href="Index.php?action=Camisillas" class="option" value="camisillas">Camisillas</a></h5></button>
  </div>
</section>
<br/><br/><br/>

<?php if(isset($_SESSION['loginUser'])): ?>
  <a class="btn btn-info" style="position: fixed; width: 70px; height: 50px; visibility: hiddwn; float: left;" data-bs-toggle="modal" data-bs-target="#myModal0"><i class="fa fa-solid fa-cart-plus" style="font-size: 40px"></i></a>
<?php endif ?>
<!--===================================
  =========INICIO DE MODAL=============
  ===================================== -->
<div class="modal fade" id="myModal0">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-black">

      <!--Modal Header boton cerrar modal-->
      <div class="modal-header">
       <!-- <button type="button" class="close btn-close bg-white" data-bs-dismiss="modal"></button>-->
      </div>
       <!--Modal body-->
      <div class="modal-body" style="padding: 0%;">
 <!--===================================
  =========INICIO CARRITO MODAL=====
  ===================================== -->

   <div class="row g-5" data-bs-toggle="">
      <div  class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Mi carrito &nbsp;<i class="fa fa-solid fa-cart-plus"></i></span>
          <span class="badge bg-primary rounded-pill">3</span>
        </h4>

        <div class="table-responsive">
        <table id="cart" class="table table-striped bg-light">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Descripción</th>                                            
                        <th>Detalle</th>   
                        <th>Cantidad</th>                      
                        <th>Precio</th>    
                    </tr>
                </thead>             
            </table>
      </div>
        <div  class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Bono redimible</h6>
              <small>EXAMPLECODE</small>
              <span class="text-success">−5%</span>
            </div>
        <div class="bg-light">
        <span>Total (COP)</span>
        <strong>$104.000</strong>
      </div>
    </div>


     <!--===================================
  =========FIN CARRITO MODAL=====
  ===================================== -->
      </div>
    </div>
  </div>
    <div class="modal-footer">
        <a class="btn btn-primary" href="Index.php?action=CheckoutCompra">Ir a caja</a>
    </div>
      </div>
  </div>
</div>
<!--===================================
  =========FIN DE MODAL=============
  ===================================== -->
   <br/>
  <?php endif ?>
<?php endif ?> 
    <?php
      $mvc = new MvcController();
      $mvc -> navegacionController();
    ?> 
&nbsp;
  <footer>

<!-- PONER CARACTERISTICAS -->
 <div class="row bg-dark col-md-12 form-group nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="height: 50px;"></div>
  <div class="row bg-dark col-md-12 form-group nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
      <div class="col-1 col-md"></div>
      <div class="col-2 col-md">
        <h5 style="color: white;">Características</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Puntos de venta</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Colecciones</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="Index.php?action=Trends">Tendencias</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="Index.php?action=Gift">Premios</a></li>
        </ul>
      </div>
      <div class="col-1 col-md"></div>
      <div class="col-2 col-md">
              <h5 style="color: white;">Acerda de</h5>
         <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="Index.php?action=Fundamentals">Fundamentos</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Propósitos</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Para Inversores</a></li>
          <li class="mb-1"><a href="Index.php?action=About" class="link-secondary text-decoration-none">Acerca de</a></li>
        </ul>
      </div>
      <div class="col-3 col-md"> </div>
      <div class="col-3 col-md"></div>
    </div>
    <div class="row bg-dark col-md-12 form-group nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
      <div class="col-6 col-md">
    
      </div>
    <div class="col-6 col-md left-side" style="text-align: right;">
    <p style="font-weight: bold; color: floralwhite;">Cavedi Rossi™ - 2017 ®</p>   
    <p style="font-weight: bold; color: floralwhite;">&copy; 2017–2022 Industry, Inc. &middot; <a href="#">Condiciones</a> &middot; <a href="#">Términos</a></p>
    <p style="font-size: 12px; color: white;">Development by System32 Services</p>
      </div>
  </div>

   <?php if (isset($_GET['search'])) {
      $inf = $_GET['search']; 
    }else{
      $inf = $_GET['action'];
      } 

      if($inf != "compras"): ?>
       <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <?php endif ?>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        <script src="vista/bootstrap.bundle.min.js"></script>
        <!--<script src="vista/bootstrap.bundle.min.js.map"></script>-->
        <script src="vista/cheatsheet.js"></script>
        <<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script type="text/javascript" src="vista/modules/js/formvalidation.js"></script>
        <script type="text/javascript" src="vista/modules/js/Shopping.js"></script>
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        
  </footer>
</body>
</html>
