$(document).ready(function() {
  $('.modal').modal();
  $('.buscaCliente').select2();
  $('#cve_horario').formSelect();
  $('#hora').formSelect();
  $('.modal').removeAttr('tabindex');
});
$('#calendar').fullCalendar({
 header:{
  left:'today,prev,next, Miboton',
  center:'title',
  right: 'month, basicWeek, agendaDay',
},
customButtons:{
  Miboton:{
    text:"Información",
    click:function(){
      alert('Verde: Atendido\nAmarillo: En espera\nRojo: Cancelada');
    }
  }
},
dayClick: function(date,jsEvent,view) {
  var fecha=date.format();
  fechaSelec= new Date(fecha);
  fechaActual= new Date();
  var daySelec = fechaSelec.getDate()+1;
  var monthSelec = fechaSelec.getMonth() + 1;
  var yearSelec = fechaSelec.getFullYear();

  var dayAct = fechaActual.getDate();
  var monthAct = fechaActual.getMonth() + 1;
  var yearAct = fechaActual.getFullYear();

  console.log(dayAct,daySelec)
  if (daySelec > dayAct && monthAct==monthSelec && yearAct==yearSelec) {
    $('#formCita').trigger('reset');
    $(".buscaCliente").val('').trigger('change');
    $('#fecha').val(fecha);
    $('#modalCita').modal('open');
  } else {
    alertify.alert(
      "Error",'<div class="center-align"><b style="font-size:20px;">No se puede agendar citas en esta fecha</b><br>'+
      '<img src="../Img/cancelar.png" alt="" class="mt-2"/>'+
      '</div>').set({transition:'flipy'}).show(); 
  }
},
events:'../Prevista/pre_calendario.php'
,

eventClick:function(calEvent,jsEvent,view){
  fechaSelec= new Date(calEvent.start);
  fechaActual= new Date();
  if (fechaSelec < fechaActual) {
    alertify.alert(
      "Error",'<div class="center-align"><b style="font-size:20px;">No es posible modificar</b><br>'+
      '<img src="../Img/cancelar.png" alt="" class="mt-2"/>'+
      '</div>').set({transition:'flipy'}).show(); 
  }else{
   $('#tituloEvento').html(calEvent.title);
   $('#descripcionEvento').html(calEvent.descripcion);
   $('#cve_cita').val(calEvent.id);
   $('#e_fecha').val(calEvent.start);
   $('#modalEditCita').modal('open');
 }
},

locale: 'es',

});


$('.guardar').click(function(event) {
  var cve_empresa=$('#cve_empresa').val();
  var cve_persona=$('#cve_persona').val();
  var hora=$('#hora').val();
  var nota=$('#nota').val();
  var fecha=$('#fecha').val();
  if (cve_persona==""||hora==""||nota=="") {
    M.toast({
      html: 'Debe llenar todos los campos',
      classes:'#d32f2f red darken-2',
      displayLength:2000
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
      nota: nota,
      accion:'guardarCita'
    },
  })
  .done(function(data) {
    if (data!="error") {
      $('#calendar').fullCalendar('refetchEvents');
      $('#modalCita').modal('close');
      M.toast({
      html: 'Agendado',
      classes:'#689f38 light-green darken-2',
      displayLength:2000
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
  var cve_empresa = $('#cve_empresa').val();
  var fecha = $('#fecha').val();
  console.log(cve_horario,cve_empresa,fecha);
  $.ajax({
    url: '../Controller/Horarios.php',
    type: 'POST',
    data: {
      cve_horario: cve_horario,
      cve_empresa: cve_empresa,
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