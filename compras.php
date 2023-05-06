
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
  <?php if(isset($_SESSION['loginUser'])):?>
  <div class="container fondo">
    <br/>
        <h1 class="text-center">MIS COMPRAS</h1>
        <br />
        <br />

        <div class="table-responsive">
            <table id="datos_producto" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Mis compras</th>
                        <th>Precio</th>                                                 
                    </tr>
                </thead>
            </table>
        </div>
   </div>

           <!--===================================
  =========INICIO DE MODAL=============
  ===================================== -->

   <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:658px"> 
    <div class="modal-content">

       <!--Modal Header boton cerrar modal-->
      <div class="modal-header">
        <b><h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5></b>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

       <!--Modal body-->
      <div class="modal-body">
        <form id="formulario" method="post" enctype="multipart/form-data">
          <!--====== LINEA 1 ======-->
            <div class="row">
                  <div class="col-md-6">
                 <label for="tipo">Tipo de producto</label>
                          <select class="form-select form-group" name="tipo" id="tipo">
                            <option value="0">Escoge un producto</option>
                            <option value="1">Camisa</option>
                            <option value="2">Camibuso</option>
                            <option value="3">Camiseta</option>
                            <option value="4">Camisilla</option>
                          </select>
                        </div>              
                   <div class="col-md-6"> 
                            <label for="coleccion">Nombre de la colección</label>
                            <select class="form-select" name="coleccion" id="coleccion">                        
                          </select>
                            <br />
                    </div>
             </div>


              <div class="row">
                        <div class="col"> 
                            <label for="description">Descripción de producto</label>
                            <input type="text" name="description" id="description" class="form-control">
                            <br />
                        </div>

                        <div class="col"> 
                            <label for="detail">Detalle del producto</label>
                            <input type="text" name="detail" id="detail" class="form-control">
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col"> 
                            <label for="amount">Cantidad</label>
                            <input type="number" maxlength="4" minlength="1" name="amount" id="amount" class="form-control">
                            <br />  
                        </div>

                        <div class="col"> 
                            <label for="price">Precio unitario</label>
                            <input type="number" maxlength="6" minlength="1" name="price" id="price" class="form-control">
                            <br />  
                        </div>
                    </div>
                     <div class="row"> 
                        <div class="col"> 
                            <label for="image">Imagenes</label>
                            <img src="" id="SavedImage" style="display: none ;width: 80px; height: 80px;"></img>
                            <input type="file" name="image" id="image" class="form-control" style="color: transparent;">
                            <br />
                        </div>
                </div>
             <div class="row">
                <div class="modal-footer">
                    <input type="hidden" name="idProduct" id="idProduct">
                    <input type="hidden" name="operacion" id="operacion">
                    <input type="hidden" name="state" id="state" value="1">            
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Agregar">
               </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--===================================
  =========FIN DE MODAL=============
  ===================================== -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--Optional JavaScript! -->

      <script type="text/javascript">
            $(document).ready(function(){
            $("#botonCrear").click(function(){
                $("#formulario")[0].reset();
                $(".modal-title").text("Agregar producto");
                $("#operacion").val("Agregar");
                $("#action").val("Agregar");
                document.getElementById("SavedImage").style.display = 'none';
            });


            
            var dataTable = $('#datos_producto').DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "ajax":{
                    url: "modelo/obtenerRegistros.php",
                    //data: {function: "CtrlGetAllProducts()"},
                    type: "POST"
                },
                "columnsDefs":[
                    {
                    "targets":[0, 3, 4],
                    "orderable":false,
                    },
                ],
                "language": {
                "decimal": "",
                "emptyTable": "No hay registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
            });


            //DROPDOWN LIST
                     $('#tipo').val();
                     reloadList();

                     $('#tipo').change(function(){
                            reloadList();
                          });

                    function reloadList(){
                        $.ajax({
                            type:"POST",
                            url:"modelo/dropdown.php",
                            data: "tipo=" + $('#tipo').val(),
                            success:function(r){
                                $('#coleccion').html(r);
                                //$('#tipo').val();
                            }
                        });
                    }

                //ACCIÓN DE AGREGAR
            $("#action").on('click', function(event){
             $("#action").val("Agregar");
            event.preventDefault();
            var detail = $("#detail").val();
            var amount = $("#amount").val();
            var description = $("#description").val();


        if(detail != '' && amount != '' && description != ''){
                $.ajax({
                        url:"modelo/Agregar.php",
                        method:'POST',
                        data: new FormData(formulario), 
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            $('#formulario')[0].reset();
                            $('#modalUsuario').modal('hide');
                            dataTable.ajax.reload();
                        }
                    });
                }else{
                    alert("NO HAY INFORMACIÓN SUFICIENTE, POR FAVOR DILIGENCIA LOS CAMPOS");
                }
            })



            //ACCIÓN EDITAR
            $(document).on('click', '.editar', function(){   
            var idProduct = $(this).attr("idProduct");   
            $.ajax({
                url:"modelo/obtenerUnregistro.php",
                method: "POST",
                data:{idProduct:idProduct},
                dataType:"json",
                success:function(data)
                    {
                        //console.log(data);        
                        $('#modalUsuario').modal('show');
                        $('#tipo').val(data.tipo_producto);
                        $('#description').val(data.descripcion_producto);
                        $('#detail').val(data.detalle_producto);
                        $('#amount').val(data.cantidad_producto);
                        $('#coleccion').val(data.coleccion);
                        $('#price').val(data.precio_producto);
                        $('#SavedImage').val(data.file_producto);


                        document.getElementById("SavedImage").style.display = 'inline';
                        document.getElementById("SavedImage").src = data.ruta;
                        $('.modal-title').text("Editar Producto");
                        $('#idProduct').val(data.id_producto);                        
                        $('#action').val("Editar");
                        $('#operacion').val("Editar");

                          },
                    error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    }
                })
          });

            //ACCIÓN DE BORRAR
            $(document).on('click', '.borrar', function(){
                var idProduct = $(this).attr("idProduct");
                if(confirm("¿Esta seguro de borrar el producto número " + idProduct + "?"))
                {
                    $.ajax({
                        url:"modelo/borrar.php",
                        method:"POST",
                        data:{idProduct:idProduct},
                        success:function(data)
                        {
                            alert(data);
                            dataTable.ajax.reload();
                        }
                    });
                }
                else
                {
                    return false; 
                }
            });

        });         

      </script>

<?php elseif (!isset($_SESSION['loginUser'])):  echo '<script>window.location.replace("Index.php?action=Registro")</script>';
 ?>
<?php endif ?>
</body>
</html>
