        <?php if(!isset($_SESSION['loginUser'])):?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

  </head>
  <body class="text-center">
     <section class="content-header">
        <center><h1>¡Registrate y obtén grandes beneficios!</h1></center>
    </section></br></br></br>
    <form action="" method="post" target="_self">
    <section class="content">
        <div class="row" style="border-color: solid 2px black">
        	<div class="col-md-2"></div>
            <div class="col-md-4" style="float: right">  
                <div class="box box-primary">
                    <div class="box-body form-group" style="border-radius: 250px; border-bottom-color: solid 2px black;">
                        <!--<div class="form-group">
                            <b><label>Documento de identidad</label></b></br>
                            <input type="number" class="form-control" name="Document" maxlength="10" minlength="8" autofocus required />
                        </div></br>-->
                        <div class="form-group">
                            <b><label>Nombres</label></b></br>
                              <input type="text" class="form-control" name="name" maxlength="50" autocomplete="name" required />
                        </div></br>
                        <div class="form-group">
                            <b><label>Apellidos</label></b></br>
                             <input type="text" class="form-control" maxlength="50" name="lastname" autocomplete="lastname" required />
                        </div></br>
                         <div class="form-group">
                            <b><label>teléfono</label></b></br>
                             <input type="number" class="form-control" maxlength="10" name="phone" autocomplete="phone" required />
                        </div></br>
                        <div class="form-group">
                            <b><label>Correo eléctronico</label>&nbsp;&nbsp;<i class="fas fa-envelope"></i></b></br>
                            <input type="email"  name="email" class="form-control" id="email" autocomplete="email" onblur="ValidateEmail()" required />
                            <input type="hidden" value="0" name="emailState" id="emailState">
                            <div id="verifica1"></div>
                            <div id="verifica2"></div>
                            <div id="verifica3"></div>
                        </div></br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body" style="display: block;">
                        <div class="form-group" style="display: inline; " required>
                            <b><label>Género</label></b></br>                        
                            Masculino<input type="radio" style="margin-left: 2px; margin-right: 10px" value="Masculino" name="Sex">
                            Femenino<input type="radio" style="margin-left: 2px; margin-right: 10px" value="Femenino" name="Sex">
                           Otro <input type="radio" style="margin-left: 2px;" value="N" name="Sex">
                        </div></br></br></br>
                        <div class="form-group">
                            <b><label>Fecha de nacimiento</label></b></br>
                            <input type="date" name="dategrow" class="form-control" name="age" required/>
                        </div>
                        <div class="form-group">
                            </div></br>
                        <div class="form-group">
                            <b><label>Contraseña</label>&nbsp;&nbsp;<i class="fas fa-lock"></i></b></br>
                            <input type="password" class="form-control" name="passname" id="passname" autocomplete="password" minlength="8" required /><i class="fas fa-eye text-dark" id="eyePwd" onclick="seePwd()" style="float: right; margin-top: -30px; margin-right: 10px;"></i>
                        </div></br>
                        <div class="form-group">
                            <b><label>Confirmar Contraseña</label>&nbsp;&nbsp;<i class="fas fa-lock"></i></b></br>
                            <input type="password" class="form-control" name="passname1" id="passname2" onblur="confirma(this)" autocomplete="password" minlength="8" required />
                            <input type="hidden" name="controlPass" id="controlPass">
                            <div id="message1" ></div>
                            <div id="message2"></div>
                        </div></br>
                    </div>              
                </div>
            </div>
        </div></br></br>
             <center> <div class="form-check form-switch col-md-3">
				  		<input class="form-check-input" type="checkbox" id="mySwitch" name="information" value="yes" checked/>
  						<label class="form-check-label" for="mySwitch">Recibir información de promociones, descuentos y concursos</label>
				</div></center></br>&nbsp;
	    		  <?php
	    //LLAMAR FUNCIONES DEL SQL
	    $register = ControllerForms::CtrlRegister();
	        
        if($register == "ok" && $_POST['controlPass'] == "allow" && $_POST['emailState'] == "1"){
          echo '<script>
                    function NotReplicate(){
                          if(window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                          }
                        }

                </script>';

          echo '<script>alert("Te has registrado de manera correcta")</script>;
          <script>
                window.location.replace("Index.php?action=Users");
          </script>';
          $_SESSION['loginUser'] = $_POST['email'];
      }

      ?> 
      <!--DATOS OCULTOS PARA ESTADO Y TIPO USUARIO-->
      	<!--<input type="hidden" name="userID" value="NULL">-->
        <input type="hidden" name="estate" value="1">
      	<input type="hidden" name="userType" value="3">
        <!--<input type="hidden" name="signinDate" value="NULL">-->
          <center><div><table>
                <tr>
                    <td>
                        <button class="btn btn-primary" style="width: 200px; height: 50px;" id="registro" value="Registrarme"><a href="#" style="color: white;">Registrarme</a></button>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <button ID="btnCancelar" class="btn btn-danger" style="width: 200px; height: 50px;" value="Cancelar"><a href="Index.php?action=Registro" style="color: white;">Cancelar</button>
                    </td>
                </tr>
            </table></div></center>
  	</form>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="vista/modules/js/Registro.js"></script>
  </body>
</html>
<?php endif ?>
