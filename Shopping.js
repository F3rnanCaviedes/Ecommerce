//=======================================================================
//===FUNCION PARA INTERCAMBIAR FOCO DE IMAGEN EN PRODUCTOS DETAILSHPOP===
//=======================================================================
$(document).ready(function () {
        $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
    })

        $(document).ready(function () {
            $.ajax({   
                        type:"POST",
                        url:"vista/modules/CartCookies.php",
                        dataType: "json",  
                        success:function(r){
                            fillCart(r);    
                        }   
                    })
//=======================================================================
//============MOSTRAR NOTIFICACION EN CARRITO DE COMPRAS=================
//=======================================================================

        $(document).on('click', '#getIt', function(e){
            e.preventDefault();
        var idProd = $(this).attr("idProd");
        var cantidad = $('#ProductCount').val();
        var price = $(this).data("price");
        var name = $(this).data("name");
        var photo = $(this).data("photo");
        var eye =  $('#routeProduct').val();
        var talla = $('input[name="color_option"]:checked').val();
                if(cantidad < 1){
                        alert("Cantidad no válida, por favor digita una cantidad real");
                    }else if(talla == "" || talla == undefined || talla == null){
                        alert("¿Que talla deseas?, Por favor escoge la talla");
                    }else{
                         $.ajax({   
                                type:"POST",
                                url:"vista/modules/fillCart.php",
                                data: { "eye": eye, "idProd": idProd, "price": price, "photo": photo, "name": name, "cantidad": cantidad, "talla": talla },
                                dataType: "json",  
                                success:function(r){   
                                     $('#Counter').text(cantidad);
                                     fillCart(r);
                                     $('#prodDown').hide(500).show(500).hide(500).show(500).hide(500).show(500);
                                     $("#prodDown").click();
                                 }
                                 
                            })
                    }
                 })
                      //LLENAR CARRITO 
                function fillCart(r){
                    var talla = "---";
                    var cantidad = Object.keys(r).length;
                    var eye =  $('#routeProduct').val();
                    if(talla != "" || talla != undefined || talla != null ){
                        talla = $('input[name="color_option"]:checked').val();
                    }else{
                        var talla = "---";   
                        $('#botonera').removeClass("btn btn-default");
                        $('#botonera').addClass("btn btn-basic");
                        $('#botonera1').removeClass("btn btn-default");
                        $('#botonera1').addClass("btn btn-basic");
                    }
                                if (cantidad > 0){
                                 $('#badgeProduct').text(cantidad);
                                 r.forEach(Element => {
                                 var cantidad = $('#ProductCount').val();
                                 $("#ProductCount").append(cantidad);
                                    $('#CartList').append(
                                    `
                                    <li>
                                      <a class="dropdown-item" href="Index.php?action=DetailShop&Typeproduct=${Element['eye']}&Data=${Element['idProd']}">
                                        <!-- Message Start -->
                                        <div class="media" >
                                          <img src="${Element['photo']}" alt="product" class="img-size-50  mr-3">
                                          <div class="media-body" style="word-wrap:break-word">
                                            <h3 class="dropdown-item-title">
                                              ${Element['name']}
                                            </h3>
                                                    <span class="float-right text-sm text-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                            <p class="text-sm">Cantidad:  ${Element['cantidad']}</p>
                                            <p class="text-sm">Talla: ${Element['talla']}</p>
                                          </div>
                                        </div>
                                      </a>
                                      <div class="dropdown-divider"></div>                                 
                                    </li>
                                    `
                                    );
                                 });
                                    $('#CartList').append(                       
                                     `<div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer text-danger" id="eraseCart">Vaciar carrito  <i class="fa fa-trash float-right"></i></a>
        </div>`
                )
                             }else{
                                $('#badgeProduct').text("");
                                $("#CartList").text("");
                             }                             
                    }

            //BORRAR CARRITO
            $(document).on('click', '#eraseCart', function(e){
                e.preventDefault();
                $.ajax({   
                            type:"POST",
                            url:"vista/modules/eraseCart.php",
                            dataType: "json",  
                            success:function(r){
                                 fillCart(r);
                            }
                        });
            })
        })


 //====REGISTRAR CALIFICACION DE USUARIO===
        $(document).on('click', '#sendRating', function(e){
            e.preventDefault();
        var id_producto = $("#getIt").attr("idProd");
        var idUsuario = $("#user").val();
        var calification = $('input[name="rating"]:checked').val();
        var idComment = $("#userComment").val();
        var sesion = $("#active").val();
        var ratingCalification = $("#reCalification").val();
        var sold = $("#sold").val();
                if(sesion != 1){
                        alert("Para calificar, debes iniciar sesión primero, sino tienes usuario, regístrate");
                    }else if(calification == "" || calification == undefined){
                        alert("Si quieres calificar éste producto, debes seleccionar una estrella");
                    }else if(ratingCalification > 0){
                          var divRating = $("#divRating").prop("class", "alert alert-warning");   
                          var ticket = document.createElement("p");
                          ticket.innerHTML = "Haz calificado anteriormente este producto con " + ratingCalification + " puntos."; 
                          document.getElementById("divRating").appendChild(ticket);
                    }else{
                         $.ajax({   
                                type:"POST",
                                url:"controlador/ControllerRating.php",
                                data: {id_producto, idUsuario, calification, idComment, ratingCalification, sold },
                                //dataType: "json",
                                //contentType:false,
                                //processData:false,   
                                success:function(data){
                                    var divRating = $("#divRating").prop("class", "alert alert-success");   
                                    var ticket = document.createElement("p");
                                    ticket.innerHTML = "Haz calificado este producto con " + calification + " puntos."; 
                                    document.getElementById("divRating").appendChild(ticket);
                                 }                              
                            })
                    }
                 })


         //====REGISTRAR COMENTARIO DE USUARIO===
        $(document).on('click', '#sendRating1', function(e){
            e.preventDefault();
        var id_producto = $("#getIt").attr("idProd");
        var idUsuario = $("#user").val();
        var calification = $('input[name="rating"]:checked').val();
        var idComment = $("#userComment").val();
        var sesion = $("#active").val();
        var ratingCalification = $("#reCalification").val();
        var sold = $("#sold").val();

                if(sesion != 1){
                        alert("Para calificar, debes iniciar sesión primero, sino tienes usuario, regístrate");
                    }else if(idComment == "" || idComment.length < 10){
                        alert("¿Tienes preguntas?, Debes escribir algo");
                    }else{
                         $.ajax({   
                                type:"POST",
                                url:"controlador/ControllerRating.php",
                                data: {id_producto, idUsuario, calification, idComment, ratingCalification, sold },
                                //dataType: "json",
                                //contentType:false,
                                //processData:false,
                                success:function(data){
                                idComment = $("#userComment").val("");   
                                    var divRating = $("#divComment").prop("class", "alert alert-success");   
                                    var ticket = document.createElement("p");
                                    ticket.innerHTML = "Tu comentario se ha publicado exitosamente"; 
                                    document.getElementById("divComment").appendChild(ticket);
                                 }
                                 
                            })
                    }
                 })