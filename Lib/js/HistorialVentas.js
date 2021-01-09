  $(document).ready(function(){
    $('.datepicker').datepicker({
    	format: "yyyy-mm-dd"
    });
    $('.modal').modal();
  });

  $('.datepicker').on('change', function(event) {
  	event.preventDefault();
  	var fecha = $('.datepicker').val();
  	$.ajax({
  		url: '../Controller/Ventas.php',
  		type: 'POST',
  		data: {
  			fecha: fecha,
  			accion: 'traerVentasFecha'
  		},
  	})
  	.done(function(data) {
  		var dato = JSON.parse(data);
  		console.log(dato);
  		var tr='';
        for (var i = 0; i < dato.length; i++) {
            tr +=
            '<tr id="' + dato[i].cve_venta + '">' +
            '<td>' + dato[i].fecha + '</td>' +
            '<td>$' + dato[i].total + '</td>' +
            '<td><button class="btn modal-trigger #1976d2 blue darken-2 verDetalle" data-target="modalVenta"><i class="fas fa-plus-square"></i></button></td>'
            '</tr>';
        }

        $('.ventas tbody').html(tr);
  	})
  	.fail(function() {
  		console.log("error");
  	});
  	
  });

  $(document).on('click', '.verDetalle', function(event) {
    event.preventDefault();
    console.log("hi");
    var cve_venta=$(this).closest('tr').attr('id');
    $.ajax({
      url: '../Controller/Ventas.php',
      type: 'POST',
      data: {
        cve_venta: cve_venta,
        accion: 'detalleVenta'
      },
    })
    .done(function(data) {
      var dato=JSON.parse(data);
      var tr='';
      for (var i = 0; i < dato.length; i++) {
        tr+='<tr>'+
        '<td>'+dato[i].nombre+'</td>'+
        '<td>$'+dato[i].precio+'</td>'+
        '</tr>';
      }
      $('.detalleVenta tbody').html(tr);
    })
    .fail(function() {
      console.log("error");
    });
    
  });