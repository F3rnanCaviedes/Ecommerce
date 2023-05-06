<?php if(!isset($_SESSION['loginUser'])): ?> 

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <link rel="canonical" href="vista/modules/css/signin.css">

    

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="vista/Login.css">

    <!--<style>
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
    </style>-->

    
    <!-- Custom styles for this template -->  
    <link href="signin.css" rel="stylesheet">
  </head></br></br>
  <body class="text-center">
<main class="form-signin">

   <center><img src="vista/contenidos/principal/PhotoBase/Mark/Logo_img1.jpeg" class="bi me-2" width="50" height="50" role="img" aria-label="CavediRossi"></img> 
    <h1 class="h3 mb-3 fw-normal">Iniciar sesion</h1></center>

 <form action="" method="post" target="_self">
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" autocomplete="email-address" placeholder="name@example.com" required>
      <label for="floatingInput">Correo electrónico</label>
      <div class="invalid-feedback">
         *Por favor digite su usuario
      </div>
    </div>
    <div class="form-floating">
      <input type="password" name="enterpassname" class="form-control" id="floatingPassword" autocomplete="password" placeholder="Password" required ><i class="fas fa-eye text-dark" id="eyePwd" onclick="seePwd()" style="float: right; margin-top: -45px; margin-right: 10px;"></i>
      <label for="floatingPassword">Contraseña</label>
        <div class="invalid-feedback">
         *Por favor digite su contraseña
      </div>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me" autocomplete="Password">&nbsp; Recordar contraseña
      </label>
    </div>

          <?php
              $requestion = new ControllerForms();
              $requestion -> CtrlControllerLogin();  
           ?>
    <button  class="w-100 btn btn-lg btn-primary">Ingresar</button>
    <br/><br/>

    <center><a style="list-style: ;">Regsitrarme para obtener los beneficios</a></center>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </form>
</main>


    
  </body>
</html>

<?php endif ?>