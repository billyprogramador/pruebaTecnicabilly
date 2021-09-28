<?php
extract($_POST);
include('../class/bd.php');
$objData = new Database($DB_TYPE_MYSQL,$DB_HOST_MYSQL,$DB_NAME_MYSQL,$DB_USER_MYSQL,$DB_PASS_MYSQL);
// var_dump($_POST);
$table1="empleado";
$where1="id=".$id;
if($objData->delete($table1,$where1)){
  echo "1";
} else {
  echo "2";
}
?>
