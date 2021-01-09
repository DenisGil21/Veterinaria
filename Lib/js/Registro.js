jQuery.validator.addMethod("latino",function(value,element){
	return this.optional(element) ||   /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/.test(value)
});
$('.btnRegistro').click(function(event) {
	$("#registroUsuario").validate({
		rules:{
			nombre:{
				required:true,
				latino: true
			},
			apellidos:{
				required:true,
				latino: true
			},
			telefono:{
				required:true,
				digits: true,
				minlength: 10,
				maxlength: 10
			},
			correo:{
				required:true,
				email:true
			},
			contrasena:{
				required:true,
				minlength: 6,
				maxlength: 30
			},
			confirm_contrasena:{
				required:true,
				equalTo:"#contrasena",
				minlength: 6,
				maxlength: 30
			}
		},
		messages:{
			nombre:{
				required:"Este campo es requerido",
				latino:"Solo se aceptan letras"
			},
			apellidos:{
				required:"Este campo es requerido",
				latino:"Solo se aceptan letras"
			},
			telefono:{
				required:"Este campo es requerido",
				minlength:"Deben ser 10 digitos",
				maxlength:"Deben ser 10 digitos",
				digits: "Solo se permiten numeros enteros",
			},
			correo:{
				required:"Este campo es requerido",
				email:"Correo invalido"
			},
			contrasena:{
				required:"Este campo es requerido",
				minlength:"Deben ser al menos 6 digitos",
			},
			confirm_contrasena:{
				required:"Este campo es requerido",
				minlength:"Deben ser al menos 6 digitos",
				equalTo:"Debe ser igual a la anterior"
			}
		},
		 errorElement: "div",
		submitHandler: function(form){
			var nombre=$('#nombre').val();
			var apellidos=$('#apellidos').val();
			var telefono=$('#telefono').val();
			var correo=$('#correo').val();
			var contrasena=$('#contrasena').val();
			console.log(nombre,apellidos,telefono,correo,contrasena);
			$.ajax({
				url: 'Controller/InicioWeb.php',
				type: 'POST',
				data: {
					nombre: nombre,
					apellidos: apellidos,
					telefono: telefono,
					correo: correo,
					contrasena: contrasena,
					accion: 'registroUsuario'
				},
			})
			.done(function(data) {
				if (data!='error' && data!='correo') {
					window.location.href = "View/Inicio.php";
				}else if (data=="correo") {
					alertify.error("El correo ya existe");
				}
			})
			.fail(function() {
				console.log("error");
			});
		}
	});
	
});