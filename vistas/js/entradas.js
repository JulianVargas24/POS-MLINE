$('.tablaEntradas1').DataTable({
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});


$(".tablaEntradas1 tbody").on("click", "button.agregarProducto", function () {

    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var descripcion = respuesta["descripcion"];

            $(".nuevoProductoEntrada1").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripción del producto -->' +

                '<div class="col-xs-4" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fa fa-times"></i></button></span>' +

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" readonly required>' +

                '</div>' +

                '</div>' +


                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3 cantidadProducto" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><i>Cantidad</i></button></span>' +
                '<input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1"  required>' +
                '</div>' +
                '</div>' +


                '</div>');

            listarProductosEntrada();
        }
    })


})

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".nuevoProductoEntrada1").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarProducto") == null) {

        idQuitarProducto = [];

    } else {

        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

    }

    idQuitarProducto.push({"idProducto": idProducto});

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');

    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');

    if ($(".nuevoProducto").children().length == 0) {

        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
        $("#TotalPagado").val(0);
        listarProductosEntrada()

    } else {

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosEntrada()

    }

})


$(".nuevoProductoEntrada1").on("change", ".nuevaCantidadProducto", function () {
    listarProductosEntrada();
})


//BODEGA A BDOEGA/////////////////
$('.tablaEntradas2').DataTable({
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});


$(".tablaEntradas2 tbody").on("click", "button.agregarProducto", function () {

    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var descripcion = respuesta["descripcion"];

            $(".nuevoProductoEntrada2").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripción del producto -->' +

                '<div class="col-xs-4" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fa fa-times"></i></button></span>' +

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" readonly required>' +

                '</div>' +

                '</div>' +


                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3 cantidadProducto" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><i>Cantidad</i></button></span>' +
                '<input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1"  required>' +
                '</div>' +
                '</div>' +


                '</div>');

            listarProductosEntrada1();
        }
    })


})

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".nuevoProductoEntrada2").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarProducto") == null) {

        idQuitarProducto = [];

    } else {

        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

    }

    idQuitarProducto.push({"idProducto": idProducto});

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');

    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');

    if ($(".nuevoProducto").children().length == 0) {

        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
        $("#TotalPagado").val(0);
        listarProductosEntrada1()

    } else {

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosEntrada1()

    }

})


$(".nuevoProductoEntrada2").on("change", ".nuevaCantidadProducto", function () {
    listarProductosEntrada1();
})

////INGRESO MANUAL A BDOEGA////////


$('.tablaEntradas3').DataTable({
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});


$(".tablaEntradas3 tbody").on("click", "button.agregarProducto", function () {

    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var descripcion = respuesta["descripcion"];

            $(".nuevoProductoEntrada3").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripción del producto -->' +

                '<div class="col-xs-4" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fa fa-times"></i></button></span>' +

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" readonly required>' +

                '</div>' +

                '</div>' +


                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3 cantidadProducto" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><i>Cantidad</i></button></span>' +
                '<input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1"  required>' +
                '</div>' +
                '</div>' +


                '</div>');

            listarProductosEntrada2();
        }
    })


})

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".nuevoProductoEntrada3").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarProducto") == null) {

        idQuitarProducto = [];

    } else {

        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

    }

    idQuitarProducto.push({"idProducto": idProducto});

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');

    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');

    if ($(".nuevoProducto").children().length == 0) {

        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
        $("#TotalPagado").val(0);
        listarProductosEntrada2()

    } else {

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosEntrada2()

    }

})


$(".nuevoProductoEntrada3").on("change", ".nuevaCantidadProducto", function () {
    listarProductosEntrada2();
})


$('.tablaEntradas4').DataTable({
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});


$(".tablaEntradas4 tbody").on("click", "button.agregarProducto", function () {

    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var descripcion = respuesta["descripcion"];

            $(".nuevoProductoEntrada4").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripción del producto -->' +

                '<div class="col-xs-4" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fa fa-times"></i></button></span>' +

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" readonly required>' +

                '</div>' +

                '</div>' +


                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3 cantidadProducto" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><i>Cantidad</i></button></span>' +
                '<input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1"  required>' +
                '</div>' +
                '</div>' +


                '</div>');

            listarProductosEntrada3();
        }
    })


})

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".nuevoProductoEntrada4").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarProducto") == null) {

        idQuitarProducto = [];

    } else {

        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

    }

    idQuitarProducto.push({"idProducto": idProducto});

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');

    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');

    if ($(".nuevoProducto").children().length == 0) {

        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
        $("#TotalPagado").val(0);
        listarProductosEntrada2()

    } else {

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosEntrada2()

    }

})


$(".nuevoProductoEntrada4").on("change", ".nuevaCantidadProducto", function () {
    listarProductosEntrada3();
})


function listarProductosEntrada() {

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");


    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({
            "id_producto": $(descripcion[i]).attr("idProducto"),
            "descripcion": $(descripcion[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "id_bodega": $('#nuevaBodegaDestino').val(),
            "id_bodega_origen": $('#nuevoValorTipoEntrada').val()
        })

    }

    $("#listaProductos").val(JSON.stringify(listaProductos));

}

function listarProductosEntrada1() {

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");


    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({
            "id_producto": $(descripcion[i]).attr("idProducto"),
            "descripcion": $(descripcion[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "id_bodega": $('#nuevaBodegaDestino').val()
        })

    }

    $("#listaProductos1").val(JSON.stringify(listaProductos));

}


function listarProductosEntrada2() {

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");


    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({
            "id_producto": $(descripcion[i]).attr("idProducto"),
            "descripcion": $(descripcion[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "id_bodega": $('#nuevaBodegaDestino').val()
        })

    }

    $("#listaProductos2").val(JSON.stringify(listaProductos));

}


function listarProductosEntrada3() {

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");


    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push({
            "id_producto": $(descripcion[i]).attr("idProducto"),
            "descripcion": $(descripcion[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "id_bodega": $('#nuevaBodegaDestino').val()
        })

    }

    $("#listaProductos3").val(JSON.stringify(listaProductos));

}

/*=============================================
EDITAR ENTRADA
=============================================*/
$(".tablas").on("click", ".btnEditarEntrada", function () {
    console.log("Botón de editar entrada clicado"); //Aviso de clic

    var idEntrada = $(this).attr("idEntrada");

    console.log(idEntrada); // Verifica el valor de idEntrada

    var datos = new FormData(); // Captura todos los datos del formulario

    datos.append("idEntrada", idEntrada);


    $.ajax({
        url: "ajax/entradas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            //$("#editarCodigo").val(respuesta["codigo"]);
            $("#editarTipoEntrada").val(respuesta["tipo_entrada"]);
            $("#editarFechaEmision").val(respuesta["fecha_emision"]);
            $("#idEntrada").val(respuesta["id"]);
            $("#editarObservaciones").val(respuesta["observaciones"]);
            $("#editarBodegaDestino").val(respuesta["id_bodega_destino"]);
            $("#editarValorTipoEntrada").val(respuesta["valor_tipo_entrada"]);
        }

    })
})

/*=============================================
ELIMINAR ENTRADA
=============================================*/
$(".tablas").on("click", ".btnEliminarEntrada", function () {

    var idEntrada = $(this).attr("idEntrada");

    swal({
        title: '¿Está seguro de borrar la Entrada?',
        text: "Si no lo está, puede cancelar la acción.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar entrada'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?ruta=entrada&idEntrada=" + idEntrada;
        }
    })
})




