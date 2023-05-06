    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

 <?php if(isset($_SESSION['loginUser'])): ?>
<?php echo '<script>alert("BIENVENIDO A NUESTRA TIENDA VIRTUAL")</script>'; ?>
<?php 
      $peticion = new ControllerForms();
      $peticion -> ControllerUserLogin();

      $tipoUsuario = $_SESSION['userType'];
?>
  </head>
  <body>
      <br/><br/>

    <div class="row justify-content-center justify-content-lg-start">
    <div class="col-md-1"></div>
    <div class="col-md-5 flex" style="display: block;">
      <div class="form-group">
        <input type="hidden" name="userType" value="<?php echo $tipoUsuario; ?>">
            <b><h3> MI PERFIL </h3></b>
            <form id="formulario" method="post" enctype="multipart/form-data">
            <label>Nombres</label>
            <input type="text" id="names" name="names" class="form-control" value="<?php echo $_SESSION['userName']; ?>" disabled required>
            <label>Apellidos</label>
            <input type="text" id="lastname" name="lastname" class="form-control" minlength="3" value="<?php echo $_SESSION['userLastname']; ?>" disabled required>
            <label>Fecha de nacimiento</label>
            <input type="date" id="borndate" name="borndate" class="form-control" value="<?php echo $_SESSION['userAge']; ?>" disabled required>
            <label>Teléfono</label>
            <input type="text" id="phone" name="phone" maxlength="10" minlength="10" class="form-control" value="<?php echo $_SESSION['userPhone']; ?>" disabled>
            <label>Introducir dirección de envío<h6>(Opcional)</h6></label>
            <input type="text" class="form-control" id="direc1" maxlength="50" name="direc1" value="<?php echo $_SESSION['direc1']; ?>" disabled>
            <label>Introducir segunda dirección de envío<h6>(Opcional)</h6></label>
            <input type="text" class="form-control" id="direc2" maxlength="50" name="direc2" value="<?php echo $_SESSION['direc2']; ?>" disabled><br/>
            <input type="hidden" id="passUser" name="passUser" value="<?php echo $_SESSION['password']; ?>">
                   <hr class="my-5">
            <button type="button" id="pass" class="form-control" data-bs-toggle="collapse" data-bs-target="#password" aria-expanded="false">
             Cambiar contraseña</button>    
          <ul class="collapse row gy-3" id="passwordChange" style="display: none; list-style: none;">
          <li>
            <label>Nueva contraseña</label>
            <input type="password" id="passname" name="password1" class="form-control" disabled>
          </li>
          <li>
            <label>Confirmar nueva contraseña</label>
          <input type="password" id="passname2" onblur="confirma(this)" name="password2" class="form-control" disabled>
          <input type="hidden" name="controlPass" id="controlPass">
          </li>
          <div id="message1" ></div>
          <div id="message2"></div>
          </ul><br/>
             <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-5"></div>
                <div class="col-md-3" style="display: inline; float: right;">
                <button class="btn btn-danger" id="editar" name="editar"><i class="fa fa-pencil-alt"></i></button>
                <input type="hidden" name="idUser" value="<?php echo $_SESSION['loginUser']; ?>">
                 <input type="hidden" name="UserId" value="<?php echo $_SESSION['userId']; ?>">
                <input type="hidden" name="action" id="action">
                <button class="btn btn-primary" type="submit" id="guardar" name="guardar"><i class="fa fa-save"></i></button>
                </div>
            </div>
          </div>
          </div>
             <div class="col-md-4 col-sm-6">
            <div class="bg-blue" style="width: 200px; height: 200px; float: right; border-radius: 50px">
              <?php if(!isset($_SESSION['photography'])): ?>
                  <p> Escoge una foto</p><i class="fa fa-user" style="font-size: 200px;"></i>
                  
                   <?php elseif(isset($_SESSION['photography'])): ?>
                    <img src="<?php echo 'PhotoBase/Users/' . $_SESSION['photography']; ?>" style="height: 500px; width: 300px; border-radius: 50px;" >
                <?php endif ?>
                                    <input type="file" id="photography" name="photography" content="Subir foto" style="content: 'Subir foto'; color: transparent;" disabled><br/>

                                    <hr class="my-5">

                  <div><a href="Index.php?action=Camibusos" class="btn btn-primary">Ir de compras<i class="fa fa-solid fa-cart-plus"></i></a></div>
        </div>             
        </div>
    </form>
  </div>
</div>

    <br/><br/>
    <?php elseif (!isset($_SESSION['loginUser'])):  echo '<script>window.location.replace("Index.php?action=Registro")</script>'; ?>
  <?php endif ?>

  </body>
  <footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="vista/modules/js/formvalidation.js"> </script>
    <script type="text/javascript" src="vista/modules/js/Registro.js"></script>
  </footer>
  </html>
