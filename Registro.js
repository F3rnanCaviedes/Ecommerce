



//VALIDAR DIRECCION DE CORREO
function validateEmailAddress(email) {
var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
return re.test(email);
}

function ValidateEmail(){
	var emailaddress = $("#email").val();
	var div = document.getElementById("verifica1");
	var div2 = document.getElementById("verifica2");
	var EmailVerify = $('#emailState').val();
	var pase = $('#controlPass').val();
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailaddress)){
		EmailVerify = "1";
		pase = "allow";
	if(EmailVerify == "1") {
		texto1 = document.createTextNode(emailaddress + " está permitido ✔");
		$('#verifica1').prop("class", "alert alert-success");
		document.getElementById("verifica2").style.display = "none";
		document.getElementById("verifica1").style.display = "inline-block";
    	texto1.innerHTML;
    	div.appendChild(texto1);
    	console.log("Access: " + pase);
    	console.log(EmailVerify);
    }else if(EmailVerify == 1 && pase != "deny"){
			document.getElementById("verifica3").style.display = "none";
		}
    return (true)
  }else{
    var texto2 = document.createTextNode( "Dato no válido, por favor ingrese un correo válido");
	$('#verifica2').prop("class", "alert alert-danger");
	EmailVerify = "0";
	document.getElementById("verifica1").style.display = "none";
	document.getElementById("verifica2").style.display = "inline-block";
    texto2.innerHTML;
    div2.appendChild(texto2);
    return (false)
	}
}


	$('#email').on('blur', function(event){
    event.preventDefault();
    var email = $('#email').val();	
    var photo = $('#photo').val();
    var EmailVerify = $('#emailState').val();
    var pase = $('#controlPass').val();
          $.ajax({
                  url:"controlador/controllerEmailPhoto.php",
                  method:'POST',
                  data: {email, photo}, 
                  success: function(data){
                       EmailVerify = "0";
                       var link = 'PhotoBase/Users/' + data.photo;
                       $("#verifica3").append(data);
                       $("#photo").attr('src', link);
                       pase = "deny";
                       console.log("Access: " +pase);
                       if (EmailVerify != 0) {
	                  	   document.getElementById("verifica3").style.display = "none";                       	
                       }

                   }
                 })
          	console.log(pase);
         });


function confirma(){
	var pass1 = $('#passname').val();
	var pass2 = $('#passname2').val();

//	console.log(pass1 + " más " + pass2);
	if (pass1 != "" && pass1 == pass2) {
		$("#controlPass").val("allow");
		var div = document.getElementById("message1");
		document.getElementById("message2").style.display = "none";
		document.getElementById("message1").style.display = "inline-block";
		$("#message1").prop("class", "alert alert-success");
		var texto = document.createTextNode('Las contraseñas coinciden ✔');
		div.innerHTML;
		texto.innerHTML; 
		completo = div.appendChild(texto);
		//document.form.appendChild(div);
	}else{
		var div = document.getElementById("message2");
		document.getElementById("message1").style.display = "none";
		document.getElementById("message2").style.display = "inline-block";
		$("#message2").prop("class", "alert alert-danger");
		var texto = document.createTextNode('Las contraseñas no coinciden ✘');
		div.innerHTML;
		texto.innerHTML; 
		completo = div.appendChild(texto);
		//document.form.appendChild(div);
		$("#controlPass").val("deny");
	}
}