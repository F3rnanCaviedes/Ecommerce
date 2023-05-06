<!DOCTYPE html PUBLIC "-//W3C//DTD xhtml 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xtml1-transitional.dtd">
<html xmlns="http://www.w3c.org/1999/xhmtl" lang="es">
<head>
<meta http-equiv="content-type" type="text/html"; charset="utf-8">
<title>Cavedi Rossi</title>
  <link type="text/css" rel="Stylesheet" href="vista/modules/css/products.css" media="all"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <style type="text/css">
            #star1,#star2,#star3,#star4,#star5{
              font-size: 40px;
              cursor: pointer;
              transition: all 0.3s;
            }

            #star1:hover,#star2:hover,#star3:hover,#star4:hover,#star5:hover{
              font-size: 50px;
            }

            #radio{
              display: none;
            }

            * {box-sizing: border-box;}

            .img-zoom-container {
              position: relative;
            }

            .img-zoom-lens {
              position: absolute;
              border: 1px solid #d4d4d4;
              /*set the size of the lens:*/
              width: 40px;
              height: 40px;
            }

            .img-zoom-result {
              border: 1px solid #d4d4d4;
              /*set the size of the result div:*/
              width: 300px;
              height: 300px;
            }

  </style>
</head>
<body>

  <!-- Content Wrapper. Contains page content -->
                <?php  
                $dato = $_GET['Data'];
                $type = $_GET['Typeproduct'];
                $short = rtrim($type, "s");

                $respuesta = ControllerForms::ControllerDetailShop($dato, $type); 
               // $restriccion = ControllerForms::WhiteListShopping($dato, $type);
               // print_r($restriccion);
                $contador =  $respuesta["coleccion"];
                $response = ModelForms::mdlSelectCollection($contador);
                $result = $response["nombre_coleccion"];
                $mostrador["coleccion"] = $result;

                $database = "productos";
                $book = ModelForms::mdlSelectColor($database, $type);
    

                ?>
          <?php if (isset($respuesta) && is_array($respuesta)): ?>
     
<center>
  <div class="container">
    <!-- Main content -->
     <!-- <div class="card card-solid">-->
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">
              <?php echo $short . " " . $respuesta["descripcion_producto"]; ?></h3> 
                  <div class="col-12">
                <img src="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" class="product-image" style="height: 600px;" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active img-zoom-container"><img class="responsive" id="myimage" src="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img class="responsive" src="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img class="responsive" src="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img class="responsive" src="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img class="responsive" src="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" alt="Product Image"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h4 class="my-3"><?php echo $short . " " . $respuesta["descripcion_producto"]; ?></h4>
              <p>Escoge el color o la combinación de colores que mejor se adapte a tus gustos, si ves un nombre de color con otro color visual, es una prenda combinada, dale click y descúbre nuevas alternativas para tu estilo</p>

              <hr>
              <h4>Colores disponibles</h4>
              
              <div class="justify container">
                              <?php 
                                  foreach ($book as $key):
                                  $Products_Array = explode(" ", $key["descripcion_producto"]);
                                  $coloring = $key["color"];
                                  $typeid = $key["id_producto"];
                                  $linking = array_pop($Products_Array);
                                  $route = "Index.php?action=DetailShop&Typeproduct=". $type ."&Data=".$typeid;

                                ?>

                 <label class="btn btn-default text-center" for="color_option1" id="botonera">
                 <a type="button" href="Index.php?action=DetailShop&Typeproduct=<?php echo $type; ?>&Data=<?php echo $typeid; ?>"> <?php echo $linking; ?>                
                  <br>
                 <i class="fas fa-circle fa-2x text-<?php echo $coloring; ?>" style="border: 1px solid black; border-radius: 50px;"></i></a>
                </label>
                 <?php endforeach ?>

              </div>

              <h4 class="mt-3">Selecciona tu talla</h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center" id="botonera1">
                  <input type="radio" name="color_option" value="S" id="color_option_b1" autocomplete="off">
                  <span class="text-xl">S</span>
                  <br>
                  Small
                </label>
                <label class="btn btn-default text-center" id="botonera1">
                  <input type="radio" name="color_option" value="M" id="color_option_b2" autocomplete="off">
                  <span class="text-xl">M</span>
                  <br>
                  Medium
                </label>
                <label class="btn btn-default text-center" id="botonera1">
                  <input type="radio" name="color_option" value="L" id="color_option_b3" autocomplete="off">
                  <span class="text-xl">L</span>
                  <br>
                  Large
                </label>
                <label class="btn btn-default text-center" id="botonera1">
                  <input type="radio" name="color_option" value="XL" id="color_option_b4" autocomplete="off">
                  <span class="text-xl">XL</span>
                  <br>
                  Xtra-Large
                </label>
              </div>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                 $ <?php echo $respuesta["precio_producto"]; ?>
                </h2>
                <h4 class="mt-0">
                  <small>Sin IVA: $ <?php echo $respuesta["precio_producto"]; ?></small>
                </h4>
              </div><br>
              <h5 class="mt-1">Cantidad</h5>
              <input type="number" class="form-control" id="ProductCount" min="1" pattern="^[0-9]+" name="count" value="1">
              <input type="hidden" id="routeProduct" value="<?php echo $type; ?>">
              <div class="mt-4">
                <button name="boton" id="getIt" idProd="<?php echo $respuesta['id_producto']; ?>" data-name="<?php echo $respuesta["descripcion_producto"];?>" data-photo="PhotoBase/Products/<?php echo $short .'/'. $result .'/'. $respuesta["file_producto"]?>" data-price="<?php $respuesta['precio_producto'];?>" class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Añadir al carrito
                </button>

                <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-heart fa-lg mr-2"></i>
                  Añadir a mi lista de deseos
                </div>
              </div>

              <div class="mt-4 product-share">
                <a href="https://www.facebook.com/CavediRossi" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="https://web.whatsapp.com/" class="text-gray">
                  <i class="fab fa-whatsapp-square fa-2x" aria-hidden="true"></i>
                </a>
                <a href="https://web.whatsapp.com/" class="text-gray">
                  <i class="fab fa-instagram fa-2x" aria-hidden="true"></i>
                </a>
              </div>

            </div>
          </div>
           <form method="post" target="_self" id="formulario2">
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Descripción</a>
                <a class="nav-item nav-link" id="comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comentarios</a>
                <a class="nav-item nav-link" id="rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" >Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active justify" id="product-desc" role="tabpanel" aria-labelledby="desc-tab"> Nuevos diseños llegan a nosotros para brindar lo mejor en comodidad, frescura y buen estilo
               </div>
               <?php if(isset($_SESSION['loginUser'])):?>
                <?php 
                $peticion = new ControllerForms();
                $peticion -> ControllerUserLogin();
                ?>

                <!--========HABILITAR ATRIBUTOS PARA USUARIOS========-->
                <?php 
                      $idUsuario = $_SESSION['userId']; 
                      $dato = $_GET['Data'];
                      $dataCalification = ControllerForms::ctrlCalification($idUsuario, $dato);
                ?>

                <?php if($dataCalification != true || $dataCalification > 0 || $dataCalification != ""): ?>
                    <input type="hidden" name="reCalification" id="reCalification" value="<?php echo $dataCalification; ?>">

                <?php endif ?>
                    <input type="hidden" id="active" value="1"><br/>
                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['userId']; ?>" id="user">
                <?php endif ?>
                 
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="comments-tab" ><p style="color: black; border-top: -50px;">
               <div>
               <p>¿Tienes alguna pregunta? Comentala:</p><br/>
              <!--<form method="post" target="_self">-->
                  <textarea type="text" class="text-center" placeholder="Agrega un comentario" name="idComment" maxlength="250" rows="3" cols="80" id="userComment"></textarea><br/><br/>
                  <input type="button" class="btn btn-primary" style="float: right;" value="Comentar" id="sendRating1">
                  <br/><br/><div id="divComment"></div>
                <!--</form>-->
              </div>

                  <!--=========SECCION DE COMENTARIOS DE USUARIOS=========-->
                  <br/><br/>
                  <hr>
                      <?php /*
                          $peticion = new ControllerForms();
                          $peticion -> CtrlRating(); */

                        ?>
                        <input type="hidden" name="" id="sold" name="sold" value="<?php echo ""; ?>" >


                  <b><h1>Comentarios</h1></b>
                  <div class=" row container">
                    <div class="col-12"></div>
                  <?php 
                      $producto = $_GET['Data'];
                      $comentarios = ControllerForms::ctrlComments($producto);
                   ?>
              </div>
          </div>
                <div class="tab-pane fade rating-container" id="product-rating" role="tabpanel" aria-labelledby="rating-tab">
                  <p>Califica éste producto, tu calificación es importante para nosotros</p>
                  <p id="calificate">
                   <!-- <form method="post" target="_self">-->
                    <label id="label" for="star1"><input id="radio" type="radio" name="rating" value="1"><i  class="fa fa-star" id="star1"></i></label>
                    <label id="label" for="star2"><input id="radio" type="radio" name="rating" value="2"><i  class="fa fa-star" id="star2"></i></label>
                    <label id="label" for="star3"><input id="radio" type="radio" name="rating" value="3"><i class="fa fa-star" id="star3"></i></label>
                    <label id="label" for="star4"><input id="radio" type="radio" name="rating" value="4"><i class="fa fa-star" id="star4"></i></label>
                    <label id="label" for="star5"><input id="radio" type="radio" name="rating" value="5"><i class="fa fa-star" id="star5"></i></label>
                  </p>
                  <input type="button" class="btn btn-primary" value="Calificar" id="sendRating">
                  <br/><br/><div id="divRating"></div>
                <!--</form>-->
              </div>
            </div>
          </div>
          </form>


      <!-- /.card -->
      <?php elseif (!isset($respuesta) && !is_array($respuesta)):  echo '<script>window.location.replace("Index.php?action=Error404")</script>'; ?>

<?php endif ?>
    <!-- /.content -->
</div>
</center>
</div>
<footer>
</footer>
</body>
</html>
