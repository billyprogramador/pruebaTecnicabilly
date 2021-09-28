<?php
extract($_POST);
// var_dump($_POST);
include('../class/bd.php');
$objData = new Database($DB_TYPE_MYSQL,$DB_HOST_MYSQL,$DB_NAME_MYSQL,$DB_USER_MYSQL,$DB_PASS_MYSQL);
if(isset($boletin)){
  if($boletin=="on"){
    $boletin = 1;
  }
}else {
  $boletin = 0;
}

$tabla ="empleado";
$datos = [
  "nombre"=> $nombre,
  "email"=> $correo,
  "sexo"=> $sexo,
  "area_id"=> $area,
  "boletin"=> $boletin,
  "descripcion"=> $descripcion
];
if($id>0){
  $where="id=".$id;
    if($objData->update($tabla,$datos,$where)){
      echo "1";
    } else {
      echo "2";
    }
} else {
  if($objData->insert($tabla,$datos)){
    echo "1";
  } else {
    echo "2";
  }
}
?>
