<?php
include('../class/bd.php');
$objData = new Database($DB_TYPE_MYSQL,$DB_HOST_MYSQL,$DB_NAME_MYSQL,$DB_USER_MYSQL,$DB_PASS_MYSQL);
$datos=$objData->select("SELECT e.*, a.nombre as nombre_area, e.id as id_empleado FROM empleado e INNER JOIN areas a ON a.id = e.area_id");

echo "  <table class='table table-striped'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>Nombre</th>
        <th scope='col'>Correo</th>
        <th scope='col'>Sexo</th>
        <th scope='col'>Área</th>
        <th scope='col'>Descripción</th>
        <th scope='col'>Boletín</th>
        <th scope='col'>Modificar</th>
        <th scope='col'>Eliminar</th>
      </tr>
    </thead>
    <tbody>";
foreach ($datos as $key => $value) {
  $key++;
  $id = $value['id_empleado'];
  if($value['boletin']==1){
    $boletin = "Si";
  } else {
    $boletin = "No";
  }
  echo "<tr>
          <th scope='row'>".$key."</th>
          <td>".$value['nombre']."</td>
          <td>".$value['email']."</td>
          <td>".$value['sexo']."</td>
          <td>".$value['nombre_area']."</td>
          <td>".$value['descripcion']."</td>
          <td>".$boletin."</td>
          <td><button onclick='modificar_empleado(".$id.")' class='btn btn-warning' data-toggle='tooltip' data-html='true' title='Modificar'>Modificar</button></td>
          <td><button onclick='eliminar_empleado(".$id.")' class='btn btn-danger' data-toggle='tooltip' data-html='true' title='Eliminar'>Eliminar</button></td>
        </tr>";
        echo " ";
}
echo "</tbody></table>";
?>
