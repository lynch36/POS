/* CARGAR TABLA DINAMICA SALIDAS*/

/* $.ajax({

    url: "ajax/datatable-salidas.ajax.php",
    success: function (respuesta){
        console.log("respuesta", respuesta);
    }

}); */

$('.tablaSalidas').DataTable({
    "ajax": "ajax/datatable-salidas.ajax.php",
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
});

$(".tablaSalidas tbody").on("click", "button.agregarProducto", function () {
    
    idProducto = $(this).attr("idProducto");
    
    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

    datos = new FormData();
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
            
            nombre = respuesta["nombre"];
            stock = respuesta["stock"];
            precio = respuesta["precio_venta"];

            if (stock == 0) {
                swal({
                    title: "No hay Stock Disponible",
                    type: "error",
                    confirmButtonText: "Cerrar"
                });

                $("button[idProducto='" + idProducto + "']").addClass("btn-primary agregarProducto");

                return;
            }

            $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">'+
            
                    '<div class="col-xs-6" style="padding-right:0px">'+
                        
                        '<div class="input-group">'+
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
                            
                            '<input type="text" class="form-control nuevoNombreProducto" idProducto="'+idProducto+'" name="agregarProducto" style="float: none" value="'+nombre+'" readonly required>'+
                        
                        '</div>'+
                    
                    
                    '</div>'+

                    '<div class="col-xs-3">'+
                    
                        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" min="1" required>'+
                    
                    '</div>'+

                    '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
                    
                        '<div class="input-group">'+
                        
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
                        
                        '</div>'+
                    
                    '</div>'+
                '</div>');
            
            /* SUMAR TOTAL PRECIOS */
            sumarTotalPrecios();

            /* AGREGAR PRODUCTOS EN JS */
            listarProductos();

            /* PONER FORMATO AL PRECIO */
            $(".nuevoPrecioProducto").number(true, 2);
        }
    });

});


$(".tablaSalidas").on("draw.dt", function () {
   
    if (localStorage.getItem("quitarProducto") != null) {
        listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        for (i = 0; i < listaIdProductos.length; i++){
            $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');

            $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-primary agregarProducto');
        }
    }
    
});

idQuitarProducto = [];
localStorage.removeItem("quitarProducto");
/* QUITAR PRODUCTOS DE LA VENTA */
$(".formularioSalida").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    if (localStorage.getItem("quitarProducto") == null) {
        idQuitarProducto = [];
    }
    else {
        idQuitarProducto.concat(localStorage.getItem("quitarProducto")) 
    }

    idQuitarProducto.push({ "idProducto": idProducto });

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');
    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');
    

    /* SUMAR TOTAL PRECIOS */
    if ($(".nuevoProducto").children().length == 0) {
        
        $("#totalSalida").val(0);
        $("#nuevoTotalSalida").val(0);
        $("#nuevoTotalSalida").attr("total", 0);

    }
    else {
        sumarTotalPrecios();

        /* AGREGAR PRODUCTOS EN JS */
        listarProductos();
    }

    

});


numProducto = 0;

/* AGREGAR PRODUCTOS DESDE BOTON */
$(".btnAgregarProducto").click(function () {

    numProducto++;

    datos = new FormData();
    datos.append("traerProductos", "ok");

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">' +
            
                '<div class="col-xs-6" style="padding-right:0px">' +
                        
                '<div class="input-group">' +
                        
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +
                            
                '<select class="form-control nuevoNombreProducto" id="producto'+numProducto+'" idProducto name="nuevoNombreProducto" required>' +
                            
                '<option>Seleccione el Producto</option>' +
                            
                '</select>' +
                        
                '</div>' +
                    
                    
                '</div>' +

                '<div class="col-xs-3 ingresoCantidad">' +
                    
                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" value="1" stock nuevoStock min="1" required>' +
                    
                '</div>' +

                '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
                    
                '<div class="input-group">' +
                        
                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                            
                '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>' +
                        
                '</div>' +
                    
                '</div>' +
                '</div>'
            );

            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index) {

                if (item.stock != 0) {
                    
                    $("#producto"+numProducto).append(
    
                        '<option idProducto="'+item.id+'" value="'+item.nombre+'">'+item.nombre+'</option>'
    
                    );

                }
            }

            /* SUMAR TOTAL PRECIOS */
            sumarTotalPrecios();

            /* PONER FORMATO AL PRECIO */
            $(".nuevoPrecioProducto").number(true, 2);
        }

    });
});

/* SELECCIONAR PRODUCTO */
$(".formularioSalida").on("change", "select.nuevoNombreProducto", function () {
    
    nombreProducto = $(this).val();
    nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
    
    datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
            $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
            
            /* AGREGAR PRODUCTOS EN JS */
            listarProductos();
        }
    });

});

/* MODIFICAR LA CANTIDAD */
$(".formularioSalida").on("change", "input.nuevaCantidadProducto", function () {

    precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    precioFinal = ($(this).val() * precio.attr("precioReal")).toFixed(2);

    /* console.log($(this).val()); */

    precio.val(precioFinal);

    nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if (Number($(this).val()) > Number($(this).attr("stock"))) {

        $(this).val(1);

        precioFinal = $(this).val() * precio.attr("precioReal");

        precio.val(precioFinal);

        sumarTotalPrecios();
        
        swal({
            title: "La Cantidad Supero el Stock",
            text: "Solo hay " + $(this).attr("stock")+" unidades!",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    }
    /* SUMAR TOTAL PRECIOS */
    sumarTotalPrecios();

    /* AGREGAR PRODUCTOS EN JS */
    listarProductos();
});


/* SUMAR TOTAL PRECIOS */
function sumarTotalPrecios() {
    
    precioItem = $(".nuevoPrecioProducto");
    arraySumaPrecio = [];

    for (i = 0; i < precioItem.length; i++) {
        
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
        
    }
    
    function sumarArrayPrecios(total, numero) {
        
        return total + numero;

    }

    sumaTotalPrecio = (arraySumaPrecio.reduce(sumarArrayPrecios)).toFixed(2);
    
    $("#totalSalida").val(sumaTotalPrecio);
    $("#nuevoTotalSalida").val(sumaTotalPrecio);
    $("#nuevoTotalSalida").attr("total", sumaTotalPrecio);
}

/* PONER FORMATO AL PRECIO */
$("#nuevoTotalSalida").number(true, 2);

/* LISTAR PRODUCTOS */
function listarProductos() {
    listaProductos = [];

    nombre = $(".nuevoNombreProducto");
        
    cantidad = $(".nuevaCantidadProducto");
    
    precio = $(".nuevoPrecioProducto");

    for (i = 0; i < nombre.length; i++) {
        
        listaProductos.push({
            "id": $(nombre[i]).attr("idProducto"),
            "nombre": $(nombre[i]).val(),
            "cantidad": $(cantidad[i]).val(),
            "stock": $(cantidad[i]).attr("nuevoStock"),
            "precio" : $(precio[i]).attr("precioReal"),
            "total" : $(precio[i]).val()
        });
        
    }

    /* ================== 
       EN ESTO QUEDO DUDA 
       ==================*/
    $("#listaProductos").val(JSON.stringify(listaProductos));    
    
}