$('.navEmpresa').addClass('active');
$('.tabs').tabs();

$('.editEmpresa').click(function(event) {
	$('#nombre').removeAttr('disabled');
	$('#direccion').removeAttr('disabled');
	$('#telefono').removeAttr('disabled');
	$('.actEmpresa').removeAttr('disabled');
});

$('.actEmpresa').click(function(event) {
	var cve_empresa = $('#cve_empresa').val();
	var nombre = $('#nombre').val();
	var direccion = $('#direccion').val();
	var telefono = $('#telefono').val();
	var errores=0;
	errores+=vacioCheck('nombre');
	errores+=vacioCheck('direccion');
	errores+=telefonoCheck('telefono');
	if (errores>0) {
		return false;
	}
	$.ajax({
		url: '../Controller/Empresa.php',
		type: 'POST',
		data: {
			cve_empresa: cve_empresa,
			nombre:nombre,
			direccion:direccion,
			telefono:telefono,
			accion: 'actualizarEmpresa'
		},
	})
	.done(function(data) {
		if (data=="success") {
			window.location.href="Empresa.php"
		}
	})
	.fail(function() {
		console.log("error");
	});
	
});