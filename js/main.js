// function notifica(mensaje, tipo) {
//     switch (tipo) {
//         case 's':
//             alertify.notify(mensaje,'success',10, null);
//             break;
//         case 'e':
//             alertify.notify(mensaje,'error',10, null);
//             break;
//         case 'w':
//             alertify.notify(mensaje,'warning',10, null);
//             break;
//         default:
//             alertify.notify(mensaje,'normal',10, null);
//             break;
//     }
// }

//prueba
function cargar_tabla(){
  $.ajax({
      url: "php/tabladatos.php",
      type: "POST",
      data: {id:0},
      success: function(datos){
        $("#contenido").html(datos);
        $("#encabezado").removeClass("d-none");
      }
  });
}

function crea_empleado(){
  $("#encabezado").addClass("d-none");
  $.ajax({
      url: "php/formulario.php",
      type: "POST",
      data: {id:0},
      success: function(datos){
        $("#contenido").html(datos);
      }
  });
}

function modificar_empleado(id){
  $("#encabezado").addClass("d-none");
  $.ajax({
      url: "php/formulario.php",
      type: "POST",
      data: {id:id},
      success: function(datos){
        $("#contenido").html(datos);
      }
  });
}

function eliminar_empleado(id){
  if(confirm("Esta seguro que desea eliminar este registro")){
    $.ajax({
        url: "php/eliminar.php",
        type: "POST",
        data: {id:id},
        success: function(datos){
          switch (datos) {
          case '1' : alert("El registro fue eliminado correctamente");cargar_tabla(); break;
          case '2' : alert("Se presento un error al eliminar el registro"); break;
          }
        }
    });
  } else {
    alert("El registro no fue eliminado");
  }
}

function guardar(form){
  $valores_pendientes = "";
  var nombre = document.getElementById("nombre").value;
  if(nombre.trim() == ""){
    $valores_pendientes = "Nombre, "
  }
  var correo = document.getElementById("correo").value;
  if(correo.trim() == ""){
    $valores_pendientes += "Correo, "
  }
  var area = document.getElementById("area").value;
  if(area == ""){
    $valores_pendientes += "Área, "
  }
  // if(!$('#boletin').prop('checked')){
  //   $valores_pendientes += "Boletín, ";
  // }
  var descripcion = document.getElementById("descripcion").value;
  if(descripcion.trim() == ""){
    $valores_pendientes += "Descripción,"
  }
  if($valores_pendientes=="") {
    $.ajax({
      url: "php/guardar.php",
      type: "POST",
      data: $("#"+form).serialize(),
      success: function(datos){
        switch (datos) {
        case '1' : alert("Los cambios se guardaron correctamente");cargar_tabla(); break;
        case '2' : alert("Se presento un error al guardar los cambios"); break;
        }
      }
    });
  } else {
    alert("Estimado usuario por favor complete los campos: "+$valores_pendientes);
  }
}
