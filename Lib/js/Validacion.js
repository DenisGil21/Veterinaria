function vacioCheck(input){
  if ($('#'+input).val()=="") {
    $('#'+input).next('div').html('');
    $('#'+input).addClass('validate invalid');
    $('#'+input).after('<div class="error"></div>');
    $('#'+input).next('div').html("Campo vacio");
    setTimeout(function() {
      $('#'+input).next('div').fadeIn(1500);
    }, 500);
    setTimeout(function() {
      $('#'+input).next('div').fadeOut(1500);
    }, 3000);
    return 1;
  }else{
    $('#'+input).next('div').html('');
    return 0;
  }
}

function telefonoCheck(input){
  if ($('#'+input).val().length==0 || $('#'+input).val().length<10) {
    $('#'+input).next('div').html('');
    $('#'+input).addClass('validate invalid');
    $('#'+input).after('<div class="error"></div>');
    $('#'+input).next('div').html("Teléfono invalido");
    setTimeout(function() {
      $('#'+input).next('div').fadeIn(1500);
    }, 500);
    setTimeout(function() {
      $('#'+input).next('div').fadeOut(1500);
    }, 3000);
    return 1;
  }else if($('#'+input).val().length==10){
    $('#'+input).next('div').html('');
    return 0;
  }
}

function correoCheck(input){
 var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
 if (regex.test($('#'+input).val().trim())!= true &&  $('#'+input).val().length>0) {
  $('#'+input).next('div').html('');
  $('#'+input).addClass('validate invalid');
  $('#'+input).after('<div class="error"></div>');
  $('#'+input).next('div').html("Correo invalido");
  setTimeout(function() {
    $('#'+input).next('div').fadeIn(1500);
  }, 500);
  setTimeout(function() {
    $('#'+input).next('div').fadeOut(1500);
  }, 3000);
  return 1;
}else{
  $('#'+input).next('div').html('');
  return 0;
}
}

function contrasenaCheck(input,input2){
  if ($('#'+input).val().length<6 && $('#'+input2).val().length>0) {
    $('#'+input).next('div').html('');
    $('#'+input).addClass('validate invalid');
    $('#'+input).after('<div class="error"></div>');
    $('#'+input).next('div').html("La contraseña deben ser al menos 6 digitos");
    setTimeout(function() {
      $('#'+input).next('div').fadeIn(1500);
    }, 500);
    setTimeout(function() {
      $('#'+input).next('div').fadeOut(1500);
    }, 3000);
    return 1;
  }else{
    $('#'+input).next('div').html('');
    return 0;
  }
}
function contrasenaCheckEdit(input,input2,input3){
  if ($('#'+input).val().length<6 && $('#'+input2).val().length>0 && $('#'+input3).val()==0) {
    $('#'+input).next('div').html('');
    $('#'+input).addClass('validate invalid');
    $('#'+input).after('<div class="error"></div>');
    $('#'+input).next('div').html("La contraseña deben ser al menos 6 digitos");
    setTimeout(function() {
      $('#'+input).next('div').fadeIn(1500);
    }, 500);
    setTimeout(function() {
      $('#'+input).next('div').fadeOut(1500);
    }, 3000);
    return 1;
  }else if($('#'+input).val().length<6 && $('#'+input).val().length>0){
    $('#'+input).next('div').html('');
    $('#'+input).addClass('validate invalid');
    $('#'+input).after('<div class="error"></div>');
    $('#'+input).next('div').html("La contraseña deben ser al menos 6 digitos");
    setTimeout(function() {
      $('#'+input).next('div').fadeIn(1500);
    }, 500);
    setTimeout(function() {
      $('#'+input).next('div').fadeOut(1500);
    }, 3000);
    return 1;
  }else{
    $('#'+input).next('div').html('');
    return 0;
  }
}

function contrasenaConfirm(input,input2){
  if ($('#'+input).val()!=$('#'+input2).val()) {
    $('#'+input).next('div').html('');
    $('#'+input2).addClass('validate invalid');
    $('#'+input2).after('<div class="error"></div>');
    $('#'+input2).next('div').html("La contraseña deben ser igual a la anterior");
    setTimeout(function() {
      $('#'+input).next('div').fadeIn(1500);
    }, 500);
    setTimeout(function() {
      $('#'+input).next('div').fadeOut(1500);
    }, 3000);
    return 1;
  }else{
    $('#'+input2).next('div').html('');
    return 0;
  }
}