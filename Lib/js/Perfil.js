$('.navPerfil').addClass('active');
$('.tabs').tabs();

$('.editPersonal').click(function(event) {
	$('#nombre').removeAttr('disabled');
	$('#apellidos').removeAttr('disabled');
	$('#telefono').removeAttr('disabled');
	$('.actPersonal').removeAttr('disabled');
});

$('.editCuenta').click(function(event) {
	$('#contrasena').removeAttr('disabled');
	$('#confirm_contrasena').removeAttr('disabled');
	$('.actCuenta').removeAttr('disabled');
});

$('.actPersonal').click(function(event) {
	var cve_usuario=$('#cve_usuario').val();
	var nombre=$('#nombre').val();
	var apellidos=$('#apellidos').val();
	var telefono=$('#telefono').val();
	var errores=0;
	errores+=vacioCheck('nombre');
	errores+=vacioCheck('apellidos');
	errores+=telefonoCheck('telefono');
	if (errores>0) {
		return false;
	}
	$.ajax({
		url: '../Controller/Perfil.php',
		type: 'POST',
		data: {
			cve_usuario: cve_usuario,
			nombre: nombre,
			apellidos: apellidos,
			telefono: telefono,
			accion: 'actualizarPersonal'
		},
	})
	.done(function() {
		window.location.href = "Perfil.php";
	})
	.fail(function() {
		console.log("error");
	});
	
});

$('.actCuenta').click(function(event) {
	var cve_usuario=$('#cve_usuario').val();
	var contrasena=$('#contrasena').val();
	var errores=0;
	errores+=contrasenaCheck('contrasena','correo');
	errores+=contrasenaConfirm('contrasena','confirm_contrasena');
	if (errores>0) {
		return false;
	}
	$.ajax({
		url: '../Controller/Perfil.php',
		type: 'POST',
		data: {
			cve_usuario: cve_usuario,
			contrasena: contrasena,
			accion: 'actualizarCuenta'
		},
	})
	.done(function() {
		window.location.href = "Perfil.php";
	})
	.fail(function() {
		console.log("error");
	});
	
});

$('.actImagen').click(function(event) {
	var cve_usuario=$('#cve_usuario').val();
	var imagen = $('#imagen')[0].files[0];
	if ($('#imagen').val()=="") {
		M.toast({
			html: 'Seleccione una imagen',
			classes:'#d32f2f red darken-2',
			displayLength:2000
		});
		return false;
	}
	var formData = new FormData();
	formData.append('imagen', imagen);
	formData.append('cve_usuario', cve_usuario);
	formData.append('accion', 'actualizarImagen');
	$.ajax({
		url: '../Controller/Perfil.php',
		type: 'POST',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
	})
	.done(function() {
		window.location.href = "Perfil.php";
	})
	.fail(function() {
		console.log("error");
	});
	
});