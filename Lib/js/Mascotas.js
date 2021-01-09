$(document).ready(function() {
	$('.modal').modal();
});

$('select').formSelect();

$('.agregar').click(function(event) {
	$('.tituloModal').html("Datos de la mascota");
	$('.btnModal').removeClass('actualizar');
	$('.btnModal').addClass('guardar');
	$('#formMascota').trigger('reset');
	$('#mostrarImg').removeAttr('src');
	$(document).on('change', '#cve_especie', function(event) {
		event.preventDefault();
		var id = $('select[name="especie"] option:selected').val();
		if (id=="") {
			return false;
		}
		$.ajax({
			url: '../Controller/Mascotas.php',
			type: 'POST',
			data: {
				cve_especie: id,
				accion:'cargarRazas'
			},
		})
		.done(function(data) {
			var dato = JSON.parse(data);
			var option = '';
			option+='<option value="" disabled selected>Seleccionar</option>';
			for (var i = 0; i < dato.length; i++) {
				option +=
				'<option value="' + dato[i].cve_raza + '">' + dato[i].nombre + '</option>';
			}
			$('#cve_raza').html(option);
			$('#cve_raza').val('');
			$('select').formSelect();
		})
		.fail(function() {
			console.log("error");
		});

	});
	var option = '';
	$('#cve_raza').html(option);
	$('select').formSelect();
});

$(document).on('click', '.guardar', function(event) {
	event.preventDefault();
	var cve_raza=$('#cve_raza').val();
	var imagen = $('#imagen')[0].files[0];
	var nombreimagen=$('#imagen').val().substr(12);
	var raza=$('select[name="razas"] option:selected').text();
	var nombre=$('#nombre').val();
	var nacimiento=$('#nacimiento').val();
	var sexo=$('#sexo').val();
	var errores=0;

	errores+=vacioCheck('cve_especie');
	errores+=vacioCheck('cve_raza');
	errores+=vacioCheck('nombre');
	errores+=vacioCheck('nacimiento');
	errores+=vacioCheck('sexo');

	if ($('#imagen').val()=="") {
		M.toast({
				html: 'No ha seleccionado una imagen',
				classes:'#d32f2f red darken-2',
				displayLength:2000
			});
		return false
	}
	
	if (errores>0) {
		return false;
	}

	var formData = new FormData();
	formData.append('imagen', imagen);
	formData.append('cve_raza', cve_raza);
	formData.append('nombre', nombre);
	formData.append('nacimiento', nacimiento);
	formData.append('sexo', sexo);
	formData.append('accion', 'guardarMascota');
	$.ajax({
		url: '../Controller/Mascotas.php',
		type: 'POST',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
	})
	.done(function(data) {
		if (data!="error") {
			var sexo2=(sexo==1)? "Macho":"Hembra";
			var tr =
			'<tr id=' + data + ' cve_raza=' + cve_raza + ' mascota=' + nombre + ' nacimiento=' + nacimiento + ' sexo=' + sexo + ' imagen=' + nombreimagen + '>' +
			'<td><img src="../Img/'+nombreimagen+'" alt="" style="width:120px;"></td>'+
			'<td>' + nombre + '</td>' +
			'<td>' + raza + '</td>' +
			'<td>' + nacimiento + '</td>' +
			'<td>' + sexo2 + '</td>' +
			'<td><button class="btn  #1976d2 blue darken-2 historial"><i class="fas fa-history"></i></button></td>'+
			'<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalMascota"><i class="fas fa-edit"></i></button></td>' +
			'<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>' +
			'</tr>';
			$('.mascotas tbody').prepend(tr);
			$('.modal').modal('close');
			M.toast({
				html: 'Guardado',
				classes:'#689f38 light-green darken-2',
				displayLength:2000
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
});

var tr;
$(document).on('click', '.editar', function(event) {
	$('.tituloModal').html("Actuaizar datos de la mascota");
	$('.btnModal').removeClass('guardar');
	$('.btnModal').addClass('actualizar');
	$('#formMascota').trigger('reset');
	$('#cve_mascota').val($(this).closest('tr').attr('id'));
	$('#cve_especie').val($(this).closest('tr').attr('cve_especie'));
	var imagen = $(this).closest('tr').attr('imagen');
	$('#mostrarImg').attr('src', '../Img/'+imagen);
	$('#nombreImg').val(imagen);
	var cve_raza=$(this).closest('tr').attr('cve_raza');

	$('#nombre').val($(this).closest('tr').attr('mascota'));
	$('#nacimiento').val($(this).closest('tr').attr('nacimiento'));
	$('#sexo').val($(this).closest('tr').attr('sexo'));
	tr = $(this).closest('tr');
	$(document).on('change', '#cve_especie', function(event) {
		event.preventDefault();
		var id = $('select[name="especie"] option:selected').val();
		if (id=="") {
			return false;
		}
		$.ajax({
			url: '../Controller/Mascotas.php',
			type: 'POST',
			data: {
				cve_especie: id,
				accion:'cargarRazas'
			},
		})
		.done(function(data) {
			var dato = JSON.parse(data);
			var option = '';
			option+='<option value="" disabled selected>Seleccionar</option>';
			for (var i = 0; i < dato.length; i++) {
				option +=
				'<option value="' + dato[i].cve_raza + '">' + dato[i].nombre + '</option>';
			}
			$('#cve_raza').html(option);
			$('#cve_raza').val(cve_raza);
			$('select').formSelect();
		})
		.fail(function() {
			console.log("error");
		});

	});
});

$(document).on('click', '.actualizar', function(event) {
	event.preventDefault();
	var cve_mascota=$('#cve_mascota').val();
	var cve_raza=$('#cve_raza').val();
	var raza=$('select[name="razas"] option:selected').text();
	var nombre=$('#nombre').val();
	var nacimiento=$('#nacimiento').val();
	var sexo=$('#sexo').val();
	var imagen = $('#imagen')[0].files[0];
	var nombreimagen=$('#imagen').val().substr(12);
	var cambiodeImg=nombreimagen;
	console.log(nombreimagen);
	var errores=0;
	var vacio="lleno";
	if (nombreimagen=="") {
		vacio="vacio";
		cambiodeImg=$('#nombreImg').val();
	}
	errores+=vacioCheck('cve_especie');
	errores+=vacioCheck('cve_raza');
	errores+=vacioCheck('nombre');
	errores+=vacioCheck('nacimiento');
	errores+=vacioCheck('sexo');

	if (errores>0) {
		return false;
	}

	var formData = new FormData();
	formData.append('imagen', imagen);
	formData.append('vacio', vacio);
	formData.append('cve_mascota', cve_mascota);
	formData.append('cve_raza', cve_raza);
	formData.append('nombre', nombre);
	formData.append('nacimiento', nacimiento);
	formData.append('sexo', sexo);
	formData.append('accion', 'editarMascota');

	$.ajax({
		url: '../Controller/Mascotas.php',
		type: 'POST',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
	})
	.done(function(data) {
		if (data=="success") {
			var sexo2=(sexo==1)? "Macho":"Hembra";
			var tr2 =
			'<tr id=' + cve_mascota + ' cve_raza=' + cve_raza + ' mascota=' + nombre + ' nacimiento=' + nacimiento + ' sexo=' + sexo + ' imagen=' + cambiodeImg + '>' +
			'<td><img src="../Img/'+cambiodeImg+'" alt="" style="width:120px;"></td>'+
			'<td>' + nombre + '</td>' +
			'<td>' + raza + '</td>' +
			'<td>' + nacimiento + '</td>' +
			'<td>' + sexo2 + '</td>' +
			'<td><button class="btn  #1976d2 blue darken-2 historial"><i class="fas fa-history"></i></button></td>'+
			'<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalMascota"><i class="fas fa-edit"></i></button></td>' +
			'<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>' +
			'</tr>';
			tr.replaceWith(tr2);
			$('.modal').modal('close');
			M.toast({
				html: 'Actualizado',
				classes:'#689f38 light-green darken-2',
				displayLength:2000
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
});

$(document).on('click', '.eliminar', function(event) {
	console.log('hi');
	var cve_mascota=$(this).closest('tr').attr('id');
	var tr = $(this).closest('tr');
	alertify.confirm('Eliminar mascota', '¿Estas seguro que desea eliminar la mascota?',
		function() {
			$.ajax({
				url: '../Controller/Mascotas.php',
				type: 'POST',
				data: {
					cve_mascota: cve_mascota,
					accion: 'eliminarMascota'
				},
			})
			.done(function(data) {
				if (data=="success") {
					tr.remove();
					M.toast({
						html: 'Eliminado',
						classes:'#689f38 light-green darken-2',
						displayLength:2000
					});
				}
			})
			.fail(function() {
				console.log("error");
			});
		},
		function() {
			M.toast({
				html: 'Cancelado',
				classes:'#d32f2f red darken-2',
				displayLength:2000
			});
		});

});

$('.historial').click(function(event) {
  var cve_mascota=$(this).closest('tr').attr('id');
  $.ajax({
    url: '../Controller/Mascotas.php',
    type: 'POST',
    data: {
      cve_mascota: cve_mascota,
      accion: 'guardarCve_mascota'
    },
  })
  .done(function() {
    window.location.href = "HistorialMascota.php";
  })
  .fail(function() {
    console.log("error");
  });
  
});