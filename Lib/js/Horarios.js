$(document).ready(function() {
	$('.modal').modal();
});

$('.agregar').click(function(event) {
	$('.tituloModal').html("Horario");
	$('.btnModal').removeClass('actualizar');
	$('.btnModal').addClass('guardar');
	$('#formHorario').trigger('reset');
});

$('#modalHorario').on('click', '.guardar', function(event) {
	event.preventDefault();
	var turno=$('#turno').val();
	var hora_entrada=$('#hora_entrada').val();
	var hora_salida=$('#hora_salida').val();
	var errores=0;
	errores+=vacioCheck('turno');
	errores+=vacioCheck('hora_entrada');
	errores+=vacioCheck('hora_salida');
	if (errores>0) {
		return false;
	}
	$.ajax({
		url: '../Controller/Horarios.php',
		type: 'POST',
		data: {
			turno: turno,
			hora_entrada: hora_entrada,
			hora_salida: hora_salida,
			accion: 'guardarHorario'
		},
	})
	.done(function(data) {
		if (data!="error" && data!="incorrecto") {
			var tr =
			'<tr id=' + data + ' turno=' + turno + ' hora_entrada=' + hora_entrada + ' hora_salida=' + hora_salida + '>' +
			'<td>' + turno + '</td>' +
			'<td>' + hora_entrada + '</td>' +
			'<td>' + hora_salida + '</td>' +
			'<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalHorario"><i class="fas fa-edit"></i></button></td>' +
			'<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>' +
			'</tr>';
			$('.horarios tbody').prepend(tr);
			$('.modal').modal('close');
			M.toast({
				html: 'Guardado',
				classes:'#689f38 light-green darken-2',
				displayLength:2000
			});
		}else if (data=="incorrecto") {
			M.toast({
				html: 'Horario inválido',
				classes:'#d32f2f red darken-2',
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
	$('.tituloModal').html("Actualizar horario");
	$('.btnModal').removeClass('guardar');
	$('.btnModal').addClass('actualizar');
	$('#formHorario').trigger('reset');
	$('#cve_horario').val($(this).closest('tr').attr('id'));
	$('#turno').val($(this).closest('tr').attr('turno'));
	$('#hora_entrada').val($(this).closest('tr').attr('hora_entrada'));
	$('#hora_salida').val($(this).closest('tr').attr('hora_salida'));
	tr = $(this).closest('tr');
});

$(document).on('click', '.actualizar', function(event) {
	event.preventDefault();
	var cve_horario=$('#cve_horario').val();
	var turno=$('#turno').val();
	var hora_entrada=$('#hora_entrada').val();
	var hora_salida=$('#hora_salida').val();
	var errores=0;
	errores+=vacioCheck('turno');
	errores+=vacioCheck('hora_entrada');
	errores+=vacioCheck('hora_salida');
	if (errores>0) {
		return false;
	}
	$.ajax({
		url: '../Controller/Horarios.php',
		type: 'POST',
		data: {
			cve_horario: cve_horario,
			turno: turno,
			hora_entrada: hora_entrada,
			hora_salida: hora_salida,
			accion: 'editarHorario'
		},
	})
	.done(function(data) {
		if (data=="success") {
			var tr2 =
			'<tr id=' + cve_horario + ' turno=' + turno + ' hora_entrada=' + hora_entrada + ' hora_salida=' + hora_salida + ' >' +
			'<td>' + turno + '</td>' +
			'<td>' + hora_entrada + '</td>' +
			'<td>' + hora_salida + '</td>' +
			'<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalHorario"><i class="fas fa-edit"></i></button></td>' +
			'<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>' +
			'</tr>';
			tr.replaceWith(tr2);
			$('.modal').modal('close');
			M.toast({
				html: 'Actualizado',
				classes:'#689f38 light-green darken-2',
				displayLength:2000
			});
		}else if (data=="incorrecto") {
			M.toast({
				html: 'Horario incorrecto',
				classes:'#d32f2f red darken-2',
				displayLength:2000
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
});


$(document).on('click', '.eliminar', function(event) {
	event.preventDefault();
	var cve_horario=$(this).closest('tr').attr('id');
	var tr = $(this).closest('tr');
	alertify.confirm('Eliminar horario', '¿Estas seguro que desea eliminar el horario?',
		function() {
			$.ajax({
				url: '../Controller/Horarios.php',
				type: 'POST',
				data: {
					cve_horario: cve_horario,
					accion: 'eliminarHorario'
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