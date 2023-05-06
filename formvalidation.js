
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated')
      }, false);
    });
})();

      /*========================================================
      ======OCULTAR OPCIONES DE PAGO - CheckOutBuy======
      ========================================================*/  
    $(document).ready(function(){
    $("input[id=credito]").click(function(){
                  document.getElementById("credit").style.visiility = "visible";
                  document.getElementById("credit").style.display = "flex";
                  document.getElementById("nequi").style.display = "none";  
                  document.getElementById("efecty").style.visibility = "hidden";
     });
    $("input[id=debito]").click(function(){
                  document.getElementById("credit").style.visibility = "visible";
                  document.getElementById("credit").style.display = "flex";
                  document.getElementById("nequi").style.display = "none";
                  document.getElementById("efecty").style.visibility = "hidden";
     });
    $("input[id=ebank]").click(function(){
                  document.getElementById("nequi").style.display = "flex";
                  document.getElementById("nequi").style.visibility = "visible";
                  document.getElementById("credit").style.display = "none";
                  document.getElementById("efecty").style.visibility = "hidden";
    });
    $("input[id=convefecty]").click(function(){
                  document.getElementById("efecty").style.visibility = "visible";
                  document.getElementById("nequi").style.visibility = "hidden";
                  document.getElementById("credit").style.visibility = "hidden";
    });


      /*========================================================
      ======DESHABILITAR OPCIONES DE USUARIO Y CONTRASEÑA======
      ========================================================*/
           $('#editar').on('click', function(event){
              event.preventDefault();
                           // $("editar").val("enabled");
                            $("#names").prop('disabled', false);
                            $("#lastname").prop('disabled', false);
                            $("#borndate").prop('disabled', false);
                            $("#phone").prop('disabled', false);
                            $("#email").prop('disabled', false);
                            $("#direc1").prop('disabled', false);
                            $("#direc2").prop('disabled', false);
                            $("#photography").prop('disabled', false);
                            dato = document.getElementById("names").value;  
                          })

          $('#pass').on('click', function(event){
            event.preventDefault();
               var password = prompt("Digite su contraseña ");
               //var creado = document.createElement("input").type = "file";
               var passData = document.getElementById("passUser").value;
                           //   var añadir = password.appendChild(creado);
                  if(password == passData){
                    $("#passname").prop('disabled', false);
                    $("#passname2").prop('disabled', false);
                    document.getElementById("passwordChange").style.display = "inline";
                     $('#controlPass').val("allow");
                  }else{
                    alert("Contraseña incorrecta, por favor intentelo de nuevo");
                  }
                })

          /*==========FUNCION PARA INTERACCION======================
            ==========CON INFORMACION USUARIO======================*/

        $('#guardar').on('click', function(event){
              $('#action').val("guardar");
             // $('#editar').val("disabled"); 
          event.preventDefault();
               $.ajax({
                        url:"controlador/ControllerUser.php",
                        method:'POST',
                        data: new FormData(formulario), 
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                           $("#names").prop('disabled', true);
                            $("#lastname").prop('disabled', true);
                            $("#borndate").prop('disabled', true);
                            $("#phone").prop('disabled', true);
                            $("#direc1").prop('disabled', true);
                            $("#direc2").prop('disabled', true);
                            $("#pass1").prop('disabled', true);
                            $("#pass2").prop('disabled', true);
                            $("#photography").prop('disabled', true);
                            $("#photography").val(data.photo);
                            dato = document.getElementById("names").value;
                            alert(dato);
                        } /*error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                  }*/
                    })
                });

  });


/*==========FUNCION PARA CALIFICACION ESTRELLAS============
  ========================================================*/
var verified = document.getElementById("reCalification").value;
 //var verified = $("reCalification").val();
if(verified < 1 || verified == undefined || verified == ""){
   document.getElementById("divRating").style.visibility = "hidden";
 for (var i = 0; i < 6; i++){
      var color = "#star";
      var star = color+[i];
      $(star).on('mouseover', function(event){
       event.preventDefault();
      var inputed = $(this).parent().find("input").val();
      $(this).parent().find("input").prop('checked', true);
       for (var j = inputed; j > 0; j--){
        let star2 = "star"+[j];
        document.getElementById(star2).style.color = "yellow";
       }
      })
        $(star).on('mouseout', function(event){
       event.preventDefault();
      var inputed = $(this).parent().find("input").val();
       for (var j = inputed; j < 6; j++){
        let star2 = "star"+[j];
        document.getElementById(star2).style.color = "black";
       }
  })
      }
    }else{
            //===========COLOREAR ESTRELLAS YA CALIFICADAS=============
      $('#sendRating').prop("disabled", true);
      for (var i = 0; i < 6; i++){
      var color = "#star";
      var star = color+[i];
      var inputed = $('#reCalification').val();;
       for (var j = inputed; j > 0; j--){
        let star2 = "star"+[j];
        document.getElementById(star2).style.color = "yellow";
       }
     }
     verified = $("reCalification").val();
     console.log(verified);
       var divRating = $("#divRating").prop("class", "alert alert-warning");   
       var ticket = document.createElement("p");
       ticket.innerHTML = "Haz calificado anteriormente este producto con " + inputed + " puntos."; 
        document.getElementById("divRating").appendChild(ticket);
    }

     


      /*======================================
      ============VER CONTRASEÑA=============*/
        function seePwd(){
      var icon = document.getElementById('eyePwd').style.color = "blue";
      var eye = document.getElementById('passname');
      var eye2 = document.getElementById('passname2');     
            if (eye.type === "password" && eye2.type === "password") {
              eye.type = "text";
              eye2.type = "text";
            } else {
              eye.type = "password";
              eye2.type = "password";
            }
        }
  

  /*==========FUNCION PARA VER CONTRASEÑA============
  ========================================================*/
         function seePwd(){
      var icon = document.getElementById('eyePwd').style.fontcolor = "blue";
      var eye = document.getElementById('floatingPassword');
            if (eye.type === "password") {
              eye.type = "text";
            } else {
              eye.type = "password";
            }
        }

        /*==========FUNCION ZOOM IMAGEN PRODUCTO============
        ====================================================*/
        function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /* Create lens: */
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /* Insert lens: */
  img.parentElement.insertBefore(lens, img);
  /* Calculate the ratio between result DIV and lens: */
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /* Set background properties for the result DIV */
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /* Execute a function when someone moves the cursor over the image, or the lens: */
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /* And also for touch screens: */
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    var pos, x, y;
    /* Prevent any other actions that may occur when moving over the image */
    e.preventDefault();
    /* Get the cursor's x and y positions: */
    pos = getCursorPos(e);
    /* Calculate the position of the lens: */
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /* Prevent the lens from being positioned outside the image: */
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /* Set the position of the lens: */
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /* Display what the lens "sees": */
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /* Get the x and y positions of the image: */
    a = img.getBoundingClientRect();
    /* Calculate the cursor's x and y coordinates, relative to the image: */
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /* Consider any page scrolling: */
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}






