$('.navVentas').addClass('active');
// Variable para hacer calculo del total de la venta
var totalVenta = 0;

$(document).ready(function() {
    $('#modalServicios').modal();
    $('#modalMascotas').modal();

});

function buscarPersona(tabla, buscador) {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById(buscador);
    filter = input.value.toUpperCase();
    table = document.getElementById(tabla);
    tr = table.getElementsByTagName("tr");
    if (filter == "") {

        $('.clientes').addClass('ocultar');

    } else if (filter != "") {

        $('.clientes').removeClass('ocultar');
    }
    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[0];
        td2 = tr[i].getElementsByTagName("td")[1];
        if (td1 || td2) {
            txtValue = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 ||
                txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

$(document).on('click', '.remover', function(event) {
    event.preventDefault();
    console.log("hola1");
    $('.cve_servicio').removeAttr('style');
    var id = $(this).closest('tr').attr('id');
    var precio = $(this).closest('tr').attr('precio');
    var tr = $(this).closest('tr');
    console.log(id, precio);
    totalVenta += parseInt(precio);
    console.log(totalVenta);
    $("#totalVenta").text('$' + totalVenta);
    $("#enviarTotal").val(totalVenta);

    $(this).text("Eliminar");
    $(this).removeClass('remover');
    $(this).addClass('removerVent');
    $(this).removeClass('#1976d2 blue darken-2');
    $(this).addClass('#d32f2f red darken-2');
    var id = tr.detach();
    $(".tablaCobrar").append(id);
    $('.modal').modal('close');

});

$(document).on('click', '.removerVent', function(event) {
    event.preventDefault();
    console.log("hola2");
    var id = $(this).closest('tr').attr('id');
    var precio = $(this).closest('tr').attr('precio');
    var tr = $(this).closest('tr');
    totalVenta -= parseInt(precio);
    console.log(totalVenta);
    $("#enviarTotal").val(totalVenta);
    $("#totalVenta").text('$' + totalVenta);

    $(this).text("Agregar");
    $(this).removeClass('removerVent');
    $(this).addClass('remover');
    $(this).removeClass('#d32f2f red darken-2');
    $(this).addClass('#1976d2 blue darken-2');
    var id = tr.detach();
    $(".servicios").append(id);

});

$('.verdtCliente').click(function(event) {
    $('.dtCliente').removeAttr('id');
    $('.clientes').addClass('ocultar');
    $('#myInput').val("");
    var cve_cliente = $(this).attr('id');
    console.log(cve_cliente);
    $.ajax({
            url: '../Controller/Ventas.php',
            type: 'POST',
            data: {
                cve_cliente: cve_cliente,
                accion: 'traerCliente'
            },
        })
        .done(function(data) {
            dato = JSON.parse(data);
            console.log(dato[0].nombre);
            if (dato.imagen != null) {
                $('.imgCliente').attr('src', '../Img/' + dato.imagen + '');
            }
            $('#cve_cliente').val(dato[0].cve_persona);
            $('.nombreCliente').text(dato[0].nombre);
            $('.telefonoCliente').text(dato[0].telefono);

        })
        .fail(function() {
            console.log("error");
        });

    $.ajax({
            url: '../Controller/Ventas.php',
            type: 'POST',
            data: {
                cve_cliente: cve_cliente,
                accion: 'traerMascotas'
            },
        })
        .done(function(data) {
            console.log(data)
            dato = JSON.parse(data);
            var tr = '';
            for (var i = 0; i < dato.length; i++) {
                console.log(dato[i].nombre);
                tr += '<tr class="verdtMascota" id="' + dato[i].cve_mascota + '" style="cursor:pointer;">' +
                    '<td>' + dato[i].nombre + '</td>' +
                    '<td>' + dato[i].raza + '</td>' +
                    '<td>' + dato[i].sexo + '</td>' +
                    '</tr>';
            }
            $('.mascotas tbody').html(tr);
        })
        .fail(function() {
            console.log("error");
        });
});

$(document).on('click', '.verdtMascota', function(event) {
    $('.dtMascota').removeAttr('id');
    $('#modalMascotas').modal('close');
    var cve_mascota = $(this).attr('id');
    $.ajax({
            url: '../Controller/Ventas.php',
            type: 'POST',
            data: {
                cve_mascota: cve_mascota,
                accion: 'traerMascota'
            },
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            $('#cve_mascota').val(dato[0].cve_mascota);
            $('.imgMascota').attr('src', '../Img/' + dato[0].imagen + '');
            $('.nombreMascota').text(dato[0].nombre);
            $('.raza').text(dato[0].raza);
            $('.sexo').text(dato[0].sexo);
        })
        .fail(function() {
            console.log("error");
        });

});

$(document).on('click', '.cobrar', function(event) {
    if ($('#cve_cliente').val() == "") {
        M.toast({
            html: 'No ha seleccionado un cliente',
            classes: '#d32f2f red darken-2',
            displayLength: 2000
        });
        return false;
    }
    if ($('#cve_mascota').val() == "") {
        M.toast({
            html: 'No ha seleccionado una mascota',
            classes: '#d32f2f red darken-2',
            displayLength: 2000
        });
        return false;
    }
    if ($('#enviarTotal').val() == "") {
        M.toast({
            html: 'Seleccione un servicio',
            classes: '#d32f2f red darken-2',
            displayLength: 2000
        });
        return false;
    }
    // if ($('#observaciones').val() == "") {
    //     M.toast({
    //         html: 'Campo observaciones vacío',
    //         classes: '#d32f2f red darken-2',
    //         displayLength: 2000
    //     });
    //     return false;
    // }
    var cve_cliente = $('#cve_cliente').val();
    var cve_mascota = $('#cve_mascota').val();
    // var observaciones = $('#observaciones').val();
    var enviarTotal = $('#enviarTotal').val();
    var servicios = [];
    table = document.getElementById("ventaServ");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        servicios[i] = tr[i].getAttribute("id");
    }
    $.ajax({
            url: '../Controller/Ventas.php',
            type: 'POST',
            data: {
                cve_cliente: cve_cliente,
                cve_mascota: cve_mascota,
                // observaciones: observaciones,
                enviarTotal: enviarTotal,
                servicios: JSON.stringify(servicios),
                accion: 'cobrarVenta'
            },
        })
        .done(function(data) {
            if (data != "error") {
                $('.dtCliente').attr('id', 'clienteOcultar');
                $('.dtMascota').attr('id', 'mascotaOcultar');
                $('#cve_cliente').val("");
                $('#cve_mascota').val("");
                $('#enviarTotal').val("");
                $(".tablaCobrar tbody").html("");
                $('#totalVenta').text("");
                // $('#observaciones').val("");
                totalVenta = 0;
                var dato = JSON.parse(data);
                var tr = '';
                for (var i = 0; i < dato.length; i++) {
                    tr +=
                        '<tr class="cve_servicio" id="' + dato[i].cve_servicio + '" nombre="' + dato[i].nombre + '" precio="' + dato[i].precio + '">' +
                        '<td>' + dato[i].nombre + '</td>' +
                        '<td>$' + dato[i].precio + '</td>' +
                        '<td><button class="btn #1976d2 blue darken-2 remover">Agregar</button></td>'
                    '</tr>';
                }

                $('.servicios tbody').html(tr);
                M.toast({
                    html: 'Venta realizada',
                    classes: '#689f38 light-green darken-2',
                    displayLength: 2000
                });
            }

        })
        .fail(function() {
            console.log("error");
        });

});

$('.limpiar').click(function(event) {
    $('.dtCliente').attr('id', 'clienteOcultar');
    $('.dtMascota').attr('id', 'mascotaOcultar');
    $('#cve_cliente').val("");
    $('#cve_mascota').val("");
    $('#enviarTotal').val("");
    $(".tablaCobrar tbody").html("");
    $('#totalVenta').text("");
    $('#observaciones').val("");
    totalVenta = 0;
    $.ajax({
            url: '../Controller/Ventas.php',
            type: 'POST',
            data: {
                accion: 'traerServicios'
            },
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            var tr = '';
            for (var i = 0; i < dato.length; i++) {
                tr +=
                    '<tr class="cve_servicio" id="' + dato[i].cve_servicio + '" nombre="' + dato[i].nombre + '" precio="' + dato[i].precio + '">' +
                    '<td>' + dato[i].nombre + '</td>' +
                    '<td>$' + dato[i].precio + '</td>' +
                    '<td><button class="btn #1976d2 blue darken-2 remover">Agregar</button></td>'
                '</tr>';
            }

            $('.servicios tbody').html(tr);
        })
        .fail(function() {
            console.log("error");
        });
});