<?php
  // запись названия поля в кэш
  session_start();
  include 'config.php';
  global $options;

  $arr_field = array( "О компании" => "c_name", "Вид деятельности" => "c_profile", "ИНН" => "inn","Адрес" => "c_address", "Директор" => "director", "Телефон" => "tel" ); 
  $field_name_str = $_GET["q"];
  $_SESSION["field_name_str"] = $field_name_str;
  $_SESSION["field_name"] = $arr_field[$field_name_str] ;
  echo($_SESSION["field_name_str"]);
   
?>