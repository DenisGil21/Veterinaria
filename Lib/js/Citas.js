$('.navCitas').addClass('active');
$(document).ready(function() {
    $('.modal').modal();
    $('.buscaCliente').select2();
    $('#cve_horario').formSelect();
    $('#hora').formSelect();
    $('.modal').removeAttr('tabindex');
});
$('#calendar').fullCalendar({
    header: {
        left: 'today,prev,next, Miboton',
        center: 'title',
        right: 'month, basicWeek, agendaDay',
    },
    customButtons: {
        Miboton: {
            text: "Información",
            click: function() {
                fechaActual = new Date();
                alert(fechaActual);
            }
        }
    },
    dayClick: function(date, jsEvent, view) {
        var fecha = date.format();
        fechaSelec = new Date(fecha);
        fechaActual = new Date();
        var daySelec = fechaSelec.getDate() + 1;
        var monthSelec = fechaSelec.getMonth() + 1;
        var yearSelec = fechaSelec.getFullYear();

        var dayAct = fechaActual.getDate();
        var monthAct = fechaActual.getMonth() + 1;
        var yearAct = fechaActual.getFullYear();

        console.log(dayAct, daySelec)
        if ((monthSelec == monthAct && yearSelec == yearAct && daySelec > dayAct) ||
            (monthSelec > monthAct && yearSelec == yearAct) || (monthSelec > monthAct && yearSelec > yearAct) ||
            (monthSelec < monthAct && yearSelec > yearAct)) {
            $('#formCita').trigger('reset');
            $(".buscaCliente").val('').trigger('change');
            $('#fecha').val(fecha);
            $('#modalCita').modal('open');
        } else {
            alertify.alert(
                "Error", '<div class="center-align"><b style="font-size:20px;">No se puede agendar citas en esta fecha</b><br>' +
                '<img src="../Img/cancelar.png" alt="" class="mt-2"/>' +
                '</div>').set({ transition: 'flipy' }).show();
        }
    },
    events: '../Prevista/pre_calendario.php',

    eventClick: function(calEvent, jsEvent, view) {
        fechaSelec = new Date(calEvent.start);
        fechaActual = new Date();
        if (fechaSelec < fechaActual) {
            alertify.alert(
                "Error", '<div class="center-align"><b style="font-size:20px;">No es posible modificar</b><br>' +
                '<img src="../Img/cancelar.png" alt="" class="mt-2"/>' +
                '</div>').set({ transition: 'flipy' }).show();
        } else {
            $('#tituloEvento').html(calEvent.title);
            $('#c_nombre').html(calEvent.nombre);
            $('#c_fecha').html(calEvent.fecha);
            // $('#c_nota').html(calEvent.nota);
            $('#c_hora').html(calEvent.hora);
            $('#cve_cita').val(calEvent.id);
            $('#e_fecha').val(calEvent.start);
            $('#modalEditCita').modal('open');
        }
    },

    locale: 'es',

});


$('.eliminar').click(function(event) {
    var cve_cita = $('#cve_cita').val();
    // var fehcaCita = $('#c_fecha').val();
    // var f = new Date();
    // var fAct = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();


    alertify.confirm('Eliminar cita', '¿Estas seguro que desea eliminar la cita?',
        function() {
            $.ajax({
                    url: '../Controller/Citas.php',
                    type: 'POST',
                    data: {
                        cve_cita: cve_cita,
                        accion: 'eliminarCita'
                    },
                })
                .done(function() {
                    $('#calendar').fullCalendar('refetchEvents');
                    $('#modalEditCita').modal('close');
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

$('.guardar').click(function(event) {
    var cve_empresa = $('#cve_empresa').val();
    var cve_persona = $('#cve_persona').val();
    var hora = $('#hora').val();
    // var nota = $('#nota').val();
    var fecha = $('#fecha').val();
    if (cve_persona == "") {
        M.toast({
            html: 'Seleccione un cliente',
            classes: '#d32f2f red darken-2',
            displayLength: 2000
        });
        return false;
    }
    if (cve_persona == "" || hora == "") {
        M.toast({
            html: 'Seleccione una hora',
            classes: '#d32f2f red darken-2',
            displayLength: 2000
        });
        return false;
    }
    $.ajax({
            url: '../Controller/Citas.php',
            type: 'POST',
            data: {
                cve_empresa: cve_empresa,
                cve_persona: cve_persona,
                fecha: fecha,
                hora: hora,
                // nota: nota,
                accion: 'guardarCita'
            },
        })
        .done(function(data) {
            if (data != "error") {
                $('#calendar').fullCalendar('refetchEvents');
                $('#modalCita').modal('close');
                M.toast({
                    html: 'Agendado',
                    classes: '#689f38 light-green darken-2',
                    displayLength: 2000
                });
            }
        })
        .fail(function() {
            console.log("error");
        });

});


$(document).on('change', '#cve_horario', function(event) {
    event.preventDefault();
    var cve_horario = $('select[name="turno"] option:selected').val();
    var fecha = $('#fecha').val();
    console.log(cve_horario, fecha);
    $.ajax({
            url: '../Controller/Horarios.php',
            type: 'POST',
            data: {
                cve_horario: cve_horario,
                fecha: fecha,
                accion: 'obtenerHorario',

            },
        })
        .done(function(data) {
            console.log(data);
            var horas = JSON.parse(data);
            var option = '';
            for (var i = 0; i < horas.length; i++) {
                option +=
                    '<option value="' + horas[i].hora + '">' + horas[i].hora + '</option>';
            }
            $('#hora').html(option);
            $('#hora').formSelect();
        })
        .fail(function() {
            console.log("error");
        });

});