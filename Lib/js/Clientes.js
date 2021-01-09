//Carga de tabla de clientes
$.ajax({
        url: '../Prevista/TablaUsuarios.php',
        type: 'POST',
    })
    .done(function(r) {
        $('#allTable').html(r);
        $('#tabla').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "search": "Buscar:",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "",
                "zeroRecords": "No se encontraron coincidencias",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
            "lengthMenu": [5, 10]
        });

        $("select").val('10');
        $('select').addClass("browser-default");

        $('.navClientes').addClass('active');
        $(document).ready(function() {
            $('.modal').modal();
        });
    })
    .fail(function() {
        console.log("error");
    });


$('.agregar').click(function(event) {
    $('.btnModal').removeClass('actualizar');
    $('.btnModal').addClass('guardar');
    $('#formCliente').trigger('reset');
    $('#correo').removeAttr('disabled');
    $('.tituloModal').html("Datos del cliente");
});

$('#modalCliente').on('click', '.guardar', function(event) {
    event.preventDefault();

    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    var nombre = $('#nombre').val();
    var apellidos = $('#apellidos').val();
    var telefono = $('#telefono').val();
    var correo = $('#correo').val();
    var contrasena = $('#contrasena').val();
    var errores = 0;

    errores += vacioCheck('nombre');
    errores += vacioCheck('apellidos');
    errores += telefonoCheck('telefono');
    errores += correoCheck('correo');
    errores += contrasenaCheck('contrasena', 'correo');
    errores += contrasenaConfirm('contrasena', 'confirm_contrasena');

    if (errores > 0) {
        return false;
    }

    $.ajax({
            url: '../Controller/Clientes.php',
            type: 'POST',
            data: {
                nombre: nombre,
                apellidos: apellidos,
                telefono: telefono,
                correo: correo,
                contrasena: contrasena,
                accion: 'guardarCliente'
            },
        })
        .done(function(data) {
            if (data != "error" && data != "correo") {
                $('#allTable').html(data);
                $('.modal').modal('close');
                M.toast({
                    html: 'Guardado',
                    classes: '#689f38 light-green darken-2',
                    displayLength: 2000
                });
                $('#tabla').DataTable({
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "search": "Buscar:",
                        "info": "",
                        "infoEmpty": "",
                        "infoFiltered": "",
                        "zeroRecords": "No se encontraron coincidencias",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    },
                    "lengthMenu": [5, 10]
                });

                $("select").val('10');
                $('select').addClass("browser-default");

                $('.navClientes').addClass('active');
                $(document).ready(function() {
                    $('.modal').modal();
                });
            } else {
                M.toast({
                    html: 'El correo ya existe',
                    classes: '#d32f2f red darken-2',
                    displayLength: 2000
                });
            }
        })
        .fail(function() {
            console.log("error");
        });
});

$(document).on('click', '.eliminar', function(event) {
    event.preventDefault();
    console.log('hi');
    var cve_persona = $(this).closest('tr').attr('id');
    var tr = $(this).closest('tr');
    alertify.confirm('Eliminar cliente', '¿Estas seguro que desea eliminar el cliente?',
        function() {
            $.ajax({
                    url: '../Controller/Clientes.php',
                    type: 'POST',
                    data: {
                        cve_persona: cve_persona,
                        accion: 'eliminarCliente'
                    },
                })
                .done(function(data) {
                    $('#allTable').html(data);
                    $('#tabla').DataTable({
                        "language": {
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "search": "Buscar:",
                            "info": "",
                            "infoEmpty": "",
                            "infoFiltered": "",
                            "zeroRecords": "No se encontraron coincidencias",
                            "paginate": {
                                "first": "Primero",
                                "last": "Último",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            },
                        },
                        "lengthMenu": [5, 10]
                    });

                    $("select").val('10');
                    $('select').addClass("browser-default");

                    $('.navClientes').addClass('active');

                    M.toast({
                        html: 'Eliminado',
                        classes: '#689f38 light-green darken-2',
                        displayLength: 2000
                    });
                })
                .fail(function() {
                    console.log("error");
                });
        },
        function() {
            M.toast({
                html: 'Cancelado',
                classes: '#d32f2f red darken-2',
                displayLength: 2000
            });
        });

});
var tr
$(document).on('click', '.editar', function(event) {
    $('.tituloModal').html("Actualizar datos del cliente");
    $('.btnModal').removeClass('guardar');
    $('.btnModal').addClass('actualizar');
    $('#formCliente').trigger('reset');
    $('#cve_persona').val($(this).closest('tr').attr('id'));
    $('#nombre').val($(this).closest('tr').attr('nombre'));
    $('#apellidos').val($(this).closest('tr').attr('apellidos'));
    $('#telefono').val($(this).closest('tr').attr('telefono'));
    $('#correo').val($(this).closest('tr').attr('correo'));
    if ($(this).closest('tr').attr('correo') != "") {
        $('#correo').attr('disabled', 'disabled');
        $('#tieneCorreo').val(1);
    } else {
        $('#correo').removeAttr('disabled');
        $('#tieneCorreo').val(0);
    }
    tr = $(this).closest('tr');
});

$(document).on('click', '.actualizar', function(event) {
    event.preventDefault();
    console.log('haha');
    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    var cve_persona = $('#cve_persona').val();
    var nombre = $('#nombre').val();
    var apellidos = $('#apellidos').val();
    var telefono = $('#telefono').val();
    var correo = $('#correo').val();
    var contrasena = $('#contrasena').val();
    var errores = 0;
    errores += vacioCheck('nombre');
    errores += vacioCheck('apellidos');
    errores += vacioCheck('telefono');
    errores += telefonoCheck('telefono');
    errores += correoCheck('correo');
    errores += contrasenaCheckEdit('contrasena', 'correo', 'tieneCorreo');
    errores += contrasenaConfirm('contrasena', 'confirm_contrasena');
    if (errores > 0) {
        return false;
    }
    errores = 0;
    $.ajax({
            url: '../Controller/Clientes.php',
            type: 'POST',
            data: {
                cve_persona: cve_persona,
                nombre: nombre,
                apellidos: apellidos,
                telefono: telefono,
                correo: correo,
                contrasena: contrasena,
                accion: 'editarCliente'
            },
        })
        .done(function(data) {
            if (data != "correo") {
                $('#allTable').html(data);
                $('.modal').modal('close');
                M.toast({
                    html: 'Actualizado',
                    classes: '#689f38 light-green darken-2',
                    displayLength: 2000
                });
                $('#tabla').DataTable({
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "search": "Buscar:",
                        "info": "",
                        "infoEmpty": "",
                        "infoFiltered": "",
                        "zeroRecords": "No se encontraron coincidencias",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    },
                    "lengthMenu": [5, 10]
                });

                $("select").val('10');
                $('select').addClass("browser-default");

                $('.navClientes').addClass('active');
                $(document).ready(function() {
                    $('.modal').modal();
                });
            } else {
                M.toast({
                    html: 'El correo ya existe',
                    classes: '#d32f2f red darken-2',
                    displayLength: 2000
                });
            }
        })
        .fail(function() {
            console.log("error");
        });
});


$(document).on('click', '.mascotas', function(event) {
    var cve_persona = $(this).closest('tr').attr('id');
    $.ajax({
            url: '../Controller/Clientes.php',
            type: 'POST',
            data: {
                cve_persona: cve_persona,
                accion: 'guardarCve_cliente'
            },
        })
        .done(function() {
            window.location.href = "Mascotas.php";
        })
        .fail(function() {
            console.log("error");
        });

});