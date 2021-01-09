  $(document).ready(function(){
    $('.datepicker').datepicker({
    	format: "yyyy-mm-dd"
    });
  });

  $('.datepicker').on('change', function(event) {
  	event.preventDefault();
  	var fecha = $('.datepicker').val();
  	console.log(fecha);
  	$.ajax({
  		url: '../Controller/Mascotas.php',
  		type: 'POST',
  		data: {
  			fecha: fecha,
  			accion: 'traerHistorialFecha'
  		},
  	})
  	.done(function(data) {
  		var dato = JSON.parse(data);
  		console.log(dato);
  		var tr='';
        for (var i = 0; i < dato.length; i++) {
            tr +=
            '<tr>' +
            '<td>' + dato[i].fecha + '</td>' +
            '<td>' + dato[i].nombre + '</td>' +
            '</tr>';
        }

        $('.historial tbody').html(tr);
  	})
  	.fail(function() {
  		console.log("error");
  	});
  	
  });