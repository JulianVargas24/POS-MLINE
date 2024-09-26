
$('.tablaAjustes').DataTable( {
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );



/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/



$(".tablaAjustes tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
			console.log("respuesta Ajustes:", respuesta);
			  var descripcion = respuesta["descripcion"];
			  var stock = respuesta["stock"];



  

          	

			

          	$(".nuevoProductoDiferencia").append(


          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-3" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

			  '</div>'+
			  

	          '<!-- Cantidad del producto -->'+

              

			  '<div class="col-xs-3 stockProducto" style="padding-right:0px">'+
              '<div class="input-group">'+
                '<span class="input-group-addon"><i>Cantidad</i></button></span>'+
	             '<input type="text" class="form-control nuevaStockVirtualProducto" name="nuevaStockVirtualProducto" id="stockVirtual" min="1" value="'+stock+'"  readonly required>'+
                '</div>'+
			  '</div>' +

			  '<div class="col-xs-3 cantidadProducto" style="padding-right:0px">'+
              '<div class="input-group">'+
                '<span class="input-group-addon"><i>Stock Fisico</i></button></span>'+
	             '<input type="text" class="form-control nuevaStockFisicoProducto" name="nuevaStockFisicoProducto" id="stockFisico" min="1" value="0"  required>'+
                '</div>'+
			  '</div>' +

			  '<div class="col-xs-3 diferenciaProducto" style="padding-right:0px">'+
              '<div class="input-group">'+
                '<span class="input-group-addon"><i>Diferencia</i></button></span>'+
	             '<input type="text" class="form-control nuevaDiferenciaProducto" name="nuevaDiferenciaProducto" min="1" value="0"  readonly required>'+
                '</div>'+
			  '</div>' +
			  	

				
			
		   
            '</div>');
            listarProductosAjuste();
        }
    })
})


$(".nuevoProductoDiferencia").on("change", "input.nuevaStockFisicoProducto", function(){
	var fisico = $(this).val()
	var virtual = $(this).parent().parent().parent().children(".stockProducto").children().children(".nuevaStockVirtualProducto").val();
	var state = $(this).parent().parent().parent().children(".diferenciaProducto").children().children(".nuevaDiferenciaProducto");
	var diferencia = fisico - virtual;
    state.val(diferencia);
    
    listarProductosAjuste();

	
	
})



var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".nuevoProductoSalida").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
		$("#TotalPagado").val(0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosAjuste()

	}

})


function listarProductosAjuste(){

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaStockFisicoProducto");

    var diferencia =$(".nuevaDiferenciaProducto");


    for(var i = 0; i < descripcion.length; i++){

        listaProductos.push({ "id_producto" : $(descripcion[i]).attr("idProducto"), 
                              "descripcion" : $(descripcion[i]).val(),
                              "cantidad" : $(cantidad[i]).val(),
                              "id_bodega" : $('#nuevaBodega').val(),
                              "diferencia" :  $(diferencia[i]).val()
                            })
    }

    $("#listaProductos").val(JSON.stringify(listaProductos)); 

}
