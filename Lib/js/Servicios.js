$('.navServicios').addClass('active');
$(document).ready(function() {
    $('.modal').modal();
});


$('.agregar').click(function(event) {
    $('.tituloModal').html("Datos del servicio");
    $('.btnModal').removeClass('actualizar');
    $('.btnModal').addClass('guardar');
    $('#formServicio').trigger('reset');
});


$('#modalServicio').on('click', '.guardar', function(event) {
    event.preventDefault();

    var nombre = $('#nombre').val();
    var precio = $('#precio').val();
    var errores = 0;

    errores += vacioCheck('nombre');
    errores += vacioCheck('precio');

    if (errores > 0) {
        return false;
    }

    $.ajax({
            url: '../Controller/Servicios.php',
            type: 'POST',
            data: {
                nombre: nombre,
                precio: precio,
                accion: 'guardarServicio'
            },
        })
        .done(function(data) {
            if (data != "error") {
                var tr =
                    '<tr id=' + data + ' nombre=' + nombre + ' precio=' + precio + '>' +
                    '<td>' + nombre + '</td>' +
                    '<td>$' + precio + '</td>' +
                    '<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalServicio"><i class="fas fa-edit"></i></button></td>' +
                    '<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';
                $('.servicios tbody').prepend(tr);
                $('.modal').modal('close');
                M.toast({
                    html: 'Guardado',
                    classes: '#689f38 light-green darken-2',
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
    console.log('hi')
    var cve_servicio = $(this).closest('tr').attr('id');
    var tr = $(this).closest('tr');
    alertify.confirm('Eliminar servicio', '¿Estas seguro que desea eliminar el servicio?',
        function() {
            $.ajax({
                    url: '../Controller/Servicios.php',
                    type: 'POST',
                    data: {
                        cve_servicio: cve_servicio,
                        accion: 'eliminarServicio'
                    },
                })
                .done(function(data) {
                    if (data == "success") {
                        tr.remove();
                        M.toast({
                            html: 'Eliminado',
                            classes: '#689f38 light-green darken-2',
                            displayLength: 2000
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
                classes: '#d32f2f red darken-2',
                displayLength: 2000
            });
        })
});

var tr
$(document).on('click', '.editar', function(event) {
    $('.tituloModal').html("Actualizar datos del servicio");
    $('.btnModal').removeClass('guardar');
    $('.btnModal').addClass('actualizar');
    $('#formServicio').trigger('reset');
    $('#cve_servicio').val($(this).closest('tr').attr('id'));
    $('#nombre').val($(this).closest('tr').attr('nombre'));
    $('#precio').val($(this).closest('tr').attr('precio'));
    tr = $(this).closest('tr');
});

$(document).on('click', '.actualizar', function(event) {
    event.preventDefault();
    var cve_servicio = $('#cve_servicio').val();
    var nombre = $('#nombre').val();
    var precio = $('#precio').val();
    var errores = 0;
    errores += vacioCheck('nombre');
    errores += vacioCheck('precio');
    if (errores > 0) {
        return false;
    }
    $.ajax({
            url: '../Controller/Servicios.php',
            type: 'POST',
            data: {
                cve_servicio: cve_servicio,
                nombre: nombre,
                precio: precio,
                accion: 'editarServicio'
            },
        })
        .done(function(data) {
            if (data == "success") {
                var tr2 =
                    '<tr id=' + cve_servicio + ' nombre=' + nombre + ' precio=' + precio + '>' +
                    '<td>' + nombre + '</td>' +
                    '<td>$' + precio + '</td>' +
                    '<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalServicio"><i class="fas fa-edit"></i></button></td>' +
                    '<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>';
                tr.replaceWith(tr2);
                $('.modal').modal('close');
                M.toast({
                    html: 'Actualizado',
                    classes: '#689f38 light-green darken-2',
                    displayLength: 2000
                });
            }
        })
        .fail(function() {
            console.log("error");
        });
});