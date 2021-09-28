<?php
extract($_POST);
include('../class/bd.php');
$objData = new Database($DB_TYPE_MYSQL,$DB_HOST_MYSQL,$DB_NAME_MYSQL,$DB_USER_MYSQL,$DB_PASS_MYSQL);
if($id>0){
  $empleado=$objData->select("SELECT e.*, a.nombre as nombre_area, e.id as id_empleado, a.id as id_area FROM empleado e INNER JOIN areas a ON a.id = e.area_id WHERE e.id =".$id);
  $nombre = $empleado[0]['nombre'];
  $correo = $empleado[0]['email'];
  $sexo = $empleado[0]['sexo'];
  $area = $empleado[0]['id_area'];
  $boletin = $empleado[0]['boletin'];
  $descripcion = $empleado[0]['descripcion'];
  $deafultslectarea = "";
  if($boletin==1){
    $boletin ="checked";
  } else {
    $boletin = "";
  }
  echo "<div class='row'>
    <div class='col-sm-12 text-left'>
      <h3>Modificar Empleado</h3>
    </div>
  </div>";
} else {
  $nombre = "";
  $correo = "";
  $sexo = "";
  $area = "";
  $boletin = "";
  $descripcion = "";
  $deafultslectarea = '<option value="" disabled selected>Seleccione una opción</option>';
  echo "<div class='row'>
    <div class='col-sm-12 text-left'>
      <h3>Crear Nuevo Empleado</h3>
    </div>
  </div>";
}
  ?>
<div class="row">
  <div class="col-sm-12 text-center btn-info">
    <h2>Los campos con asteriscos (*) son obligatorios</h2>
  </div>
</div>
  <form id="formulario" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
    <div class="col-sm-12">
      <div class="row formval">
        <div class="form-group col-sm-6">
          <label for="nombre">Nombre*</label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo $nombre;?>">
        </div>
        <div class="form-group col-sm-6">
          <label for="correo">Correo*</label>
          <input type="email" class="form-control" id="correo" name="correo" placeholder="" value="<?php echo $correo;?>">
        </div>
        <div class="form-group col-sm-6">
          <label for="sede">Sexo*</label>
          <div class="form-check">
            <input class="form-check-input sexo" type="radio" name="sexo" id="sexo1" value="M" <?php echo $sexo=="M"?"checked":"";?>>
            <label class="form-check-label" for="sexo1">
              Masculino
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input sexo" type="radio" name="sexo" id="sexo2" value="F" <?php echo $sexo=="F"?"checked":"";?>>
            <label class="form-check-label" for="sexo2">
              Femenino
            </label>
          </div>
        </div>
        <div class="form-group col-sm-6">
          <label for="sede">Área*</label>
          <select  name="area" id="area" required>
              <?php
                  echo $deafultslectarea;
                  $sql=$objData->select("SELECT * FROM areas");
                  foreach ($sql as $opcion) {
                    $selected = "";
                    if($opcion['id']==$area){
                      $selected = "selected";
                    }
                    ?>
                      <option value='<?php echo $opcion['id'];?>' <?php echo $selected;?>><?php echo $opcion['nombre'];?></option>
                  <?php } ?>
          </select>
        </div>
        <div class="col-sm-6">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="boletin" name="boletin" <?php echo $boletin?>>
            <label class="form-check-label" for="boletin">Boletín</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-floating">
            <label for="descripcion">Descripcion*</label>
            <textarea class="form-control" placeholder="Por favor escribir la descripción aquí" id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
          </div>
        </div>
        <div class="col-sm-12 row">
          <div class="form-group col-sm-6 text-center mt-3">
            <button type="button" class="btn btn-secondary" onclick="cargar_tabla();">Cancelar</button>
          </div>
          <div class="form-group col-sm-6 text-center mt-3">
            <button type="button" class="btn btn-primary" onclick="guardar('formulario');">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </from>
