/* CARGAR TABLA DINAMICA */

/* $.ajax({

    url: "ajax/datatable-productos.ajax.php",
    success: function (respuesta){
        console.log("respuesta", respuesta);
    }

}); */

$('.tablaProductos').DataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
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

$("#nuevaCategoria").change(function () {
	idCategoria = $(this).val();

	datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			
			if (!respuesta) {
				nuevoCodigo = idCategoria + "01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			else {
				nuevoCodigo = Number(respuesta["codigo"]) + 1;
				$("#nuevoCodigo").val(nuevoCodigo);
			}

		}
	});
});

/* PRECIO DE VENTA */
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function () {
	
	if ($(".porcentaje").prop("checked")) {
		
		valorPorcentaje = $(".nuevoPorcentaje").val();

		porcentaje = Number(($("#nuevoPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#nuevoPrecioCompra").val());

		editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly", true);

	}
});

/* CAMBIO PORCENTAJE */
$(".nuevoPorcentaje").change(function () {

	if ($(".porcentaje").prop("checked")) {
		
		valorPorcentaje = $(this).val();

		porcentaje = Number(($("#nuevoPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#nuevoPrecioCompra").val());

		editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly", true);

	}

});

$(".porcentaje").on("ifUnchecked", function () {
	
	$("#nuevoPrecioVenta").prop("readonly", false);
	$("#editarPrecioVenta").prop("readonly", false);

}); 
	
$(".porcentaje").on("ifChecked", function () {
	
	$("#nuevoPrecioVenta").prop("readonly", true);
	$("#editarPrecioVenta").prop("readonly", true);

});


/* EDITAR PRODUCTO */
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){
	
	idProducto = $(this).attr("idProducto");

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
			
			datosCategoria = new FormData();
			datosCategoria.append("idCategoria", respuesta["id_categoria"]);

			$.ajax({
				url: "ajax/categorias.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					
					$("#editarCategoria").val(respuesta["id"]);
					$("#editarCategoria").html(respuesta["categoria"]);
		
				}
			});

			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarCantidad").val(respuesta["stock"]);
			$("#editarPrecioCompra").val(respuesta["precio_compra"]);
			$("#editarPrecioVenta").val(respuesta["precio_venta"]);

		}
	});

});


/* ELIMINAR PRODUCTO */
$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function () {
	
	idProducto = $(this).attr("idProducto");
	codigo = $(this).attr("codigo");

	swal({

		title: '¿Estas seguro de eliminar el producto?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Borrar Producto',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar'
		}).then((result) => {
		if (result.value) {
			
			window.location = "index.php?ruta=productos&idProducto=" + idProducto + "&codigo=" + codigo;
		
		}
		

	});

});