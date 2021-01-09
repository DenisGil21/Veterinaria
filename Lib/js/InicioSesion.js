jQuery.validator.addMethod("latino", function(value, element) {
    return this.optional(element) || /^[a-zA-Z]+$/.test(value)
});
$('.btnInicioSesion').click(function(event) {
    $("#login").validate({
        onfocusout: false,
        rules: {
            correo: {
                required: true,
                email: true
            },
            contrasena: {
                required: true
            }
        },
        messages: {
            correo: {
                required: "Este campo es requerido",
                email: "Correo invalido"
            },
            contrasena: {
                required: "Este campo es requerido"
            }
        },
        errorElement: "div",
        highlight: function(element, errorClass) { //los objetos que no cumplan con la validación parpadearan 
            $(element).fadeOut(function() {
                $(element).fadeIn();
            });
        },
        submitHandler: function(form) {

            $('.carga').html(`<div class="preloader-wrapper small active">
				<div class="spinner-layer spinner-green-only">
				<div class="circle-clipper left">
				<div class="circle"></div>
				</div><div class="gap-patch">
				<div class="circle"></div>
				</div><div class="circle-clipper right">
				<div class="circle"></div>
				</div>
				</div>
				</div>`);
            var correo = $('#correo').val();
            var contrasena = $('#contrasena').val();
            $.ajax({
                    url: 'Controller/InicioWeb.php',
                    type: 'POST',
                    data: {
                        correo: correo,
                        contrasena: contrasena,
                        accion: 'inicioSesion'
                    },
                })
                .done(function(data) {
                    if (data == 1) {
                        window.location.href = "View/Admin.php";
                    } else if (data == 3) {
                        window.location.href = "View/Inicio.php";
                    } else {
                        $(".preloader-wrapper").remove();
                        M.toast({
                            html: 'Correo o contraseña incorrectos',
                            classes: '#d32f2f red darken-2',
                            displayLength: 2000
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        }
    });
});