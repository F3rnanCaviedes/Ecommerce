<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="Cavedi Rossi">
    <meta name="author" content="Férnan Caviedes">
    <title>Cavedi Rossi</title>


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
    <link href="vista/modules/css/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Confirma tus datos</h2>
      <p class="lead">Este paso es importante para que puedas realizar una compra segura, acertada y efectiva, sin inconvenientes de productos o precios no deseados, por favor confirma tus datos</p>
    </div>

    <div class="row g-5" >
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Mi carrito &nbsp;<i class="fa fa-solid fa-cart-plus"></i></span>
          <span class="badge bg-primary rounded-pill">3</span>
        </h4>
         <!--===================================
  =========INICIO CARRITO MODAL=====
  ===================================== -->

   <div class="row g-5">
      <div  class="order-md-last" style="height: 100px;">
        <table class="table table-striped bg-light" >
          <thead>
            <tr>
              <th>Prenda</th>
              <th>Detalle</th>
              <th>Precio</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>

          <tr>
            <td><h6 class="my-0"></h6></td>
            <th><small class="text-muted"></small></th>
            <td><span class="text-muted"><p></p></span></td>
            <td><input type="number" name="cantidad" value="1" maxlength="2" style="width: 30%; float: left;"></td>
            <td><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></td>
          </tr>
          </tbody>
        </table>
          <div class="list-group-item d-flex justify-content-between bg-light">
                  <div class="text-success">
                    <h6 class="my-0">Codigo redimible</h6>
                    <small>EXAMPLECODE</small>
                  </div>
                  <span class="text-success">−5%</span>
          </div>
          <div class="list-group-item d-flex justify-content-between">
            <span>Total (COP)</span>
            <strong>$104.000</strong>
          </div>
      </div>
    </div>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
      </div>
  <!--===================================
  =========FIN CARRITO VENTANA=====
  ===================================== -->


      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Dirección de envío</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-12">
              <?php 
      $peticion = new ControllerForms();
      $peticion -> ControllerUserLogin();
              ?>
              <!--PREGUNTAR SI ESTÁ LOGGUEADO-->
              <?php if(isset($_SESSION['loginUser'])): ?>
              <label for="Name" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $_SESSION['userName']." ".$_SESSION['userLastname'] ?>" disabled>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>  

            <div class="col-md-12">
              <label for="email" class="form-label">Correo Electrónico</label>
              <div class="input-group has-validation">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="text" class="form-control" id="email" value="<?php echo $_SESSION['loginUser'] ?>" placeholder="you@example.com" disabled>
              <div class="invalid-feedback">
                  el dato correo es requerido.
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label for="address" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="address" value="<?php echo $_SESSION['direc1'] ?>" placeholder="Dirección principal" disabled>
              <div class="invalid-feedback">
                Por favor ingresa tu dirección principal de envío.
              </div>
            </div>

            <div class="col-md-12">
              <label for="address2" class="form-label">Dirección 2 <span class="text-muted">(Opcional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Segunda dirección">
              <div class="invalid-feedback">
                Por favor ingresa tu segunda dirección de envío.
              </div>
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Pais</label>
              <select class="form-select" id="country" enable="false" required>
                <option value="">Colombia</option>
                <option></option>
              </select>
              <div class="invalid-feedback">
                Por favor selecciona una opción.
              </div>
            </div>
          <?php elseif(!isset($_SESSION['loginUser'])): ?>
            <div class="col-12">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" placeholder="correo@example.com" required>
              <div class="invalid-feedback">
               Por favor ingresa una dirección válida de correo.
              </div>
            </div>

                      <div class="col-md-12">
              <label for="address" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="address" placeholder="Dirección principal" required>
              <div class="invalid-feedback">
                Por favor ingresa tu dirección principal de envío.
              </div>
            </div>

            <div class="col-md-12">
              <label for="address2" class="form-label">Dirección 2 <span class="text-muted">(Opcional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Segunda dirección">
              <div class="invalid-feedback">
                Por favor ingresa tu segunda dirección de envío.
              </div>
            </div>
            <?php endif ?>
            <div class="col-md-12">
              <div class="col-md-4">
              <label for="state" class="form-label">Departamento</label>
              <select class="form-select" id="state" required>
                <option value=""></option>
                <option>Huila</option>
              </select>
              <div class="invalid-feedback">
                Debes indicar el departamento de envío.
              </div>
            </div>

             <div class="col-md-4">
              <label for="state" class="form-label">Ciudad</label>
              <select class="form-select" id="state" required>
                <option value=""></option>
                <option>Neiva</option>
              </select>
              <div class="invalid-feedback">
                Por favor escoge una ciudad válida
              </div>
            </div>
            </div>


          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Guarda esta información para la próxima vez</label>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Tipo de pago</h4>
          <h6>Clickee una sola vez para mostrar la opcion de su preferencia y otra vez para cerrarlas  </h6>

          <div class="my-3">
            <div class="form-check">
              <input id="credito" name="paymentMethod" type="radio" class="form-check-input" data-bs-toggle="collapse" data-bs-target="#credit" checked required>
              <label class="form-check-label" for="credit">Tarjeta de crédito</label>
            </div>
            <div class="form-check">
              <input id="debito" name="paymentMethod" type="radio" class="form-check-input" data-bs-toggle="collapse" data-bs-target="#credit" required>
              <label class="form-check-label" for="debit">Tarjeta débito</label>
            </div>
            <div class="form-check">
              <input id="ebank" name="paymentMethod" type="radio" class="form-check-input" data-bs-toggle="collapse" data-bs-target="#nequi" required>
              <label class="form-check-label" for="paypal">Nequi o Bancolombia a la mano</label>
            </div>
             <div class="form-check">
              <input id="convefecty" name="paymentMethod" type="radio" class="form-check-input" data-bs-toggle="collapse" data-bs-target="#convenio" required>
              <label class="form-check-label" for="paypal">Convenio Efecty</label>
            </div>
          </div>

          <div id="credit" class="collapse row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Nombre sobre tarjeta</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Nombre completo como se muestra en la tarjeta</small>
              <div class="invalid-feedback">
                *El nombre sobre la tarjeta es obligatorio
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Número de cuenta</label>
              <input type="number" class="form-control" maxlength="11" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                *El número de cuenta es obligatorio
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiración</label>
              <input type="date" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                *La fecha de expiración es obligatoria
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="number" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Código de seguridad requerido
              </div>
            </div>
          </div>

          <!--COLLAPSE SEGÚN MEDIO DE PAGO-->

          <div id="nequi" class="collapse row gy-3">
            <div  class="col-md-6">
              <label for="cc-name" class="form-label">Nombre del titular de la cuenta</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <div class="invalid-feedback">
                *El nombre del titular es obligatorio
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Número de cuenta</label>
              <input type="number" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                *el número de tarjeta es obligatorio
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Límite</label>
              <input type="date" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                *La fecha de expiración es obligatoria
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="number" class="form-control" maxlength="4" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Código de seguridad requerido
              </div>
            </div>
          </div>

          <hr class="my-4">

          <a class="w-100 btn btn-primary btn-lg" href="Index.php?action=inicio" type="submit">Comprar</a>
        </form>
      </div>
    </div>
  </main>
</div>
  </body>
</html>
