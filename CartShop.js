
//FUNCION LISTAR COLECCIONES
$(document).ready(function(){
                
             $('#').on('select', 'td',function(){
                    $.ajax({
                            type:"POST",
//                          url:"controlador/ControllerForms.php",
                            url:"vista/modules/Colections.php", 
                            data: new FormData(formulario),
                            success:function(r){
                                    $('#showing').html(r);
                            }
                        });
                })

             /*===========================================
             =====LISTAR COLECCIONES PARA PRODUCTOS=====
             ===========================================*/
         function Listar(){
                        $.ajax({
                            type:"POST",
                            url:"controlador/ControllerShop.php",
                            data: "tipo=" + $('#tipo').val(),
                            success:function(r){
                                $('#list').html(r);
                            }
                        });                                                                                              
                    }

      $('#album').click(function(){
        Listar();
          });

});