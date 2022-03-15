<?php
  /*
*  global setup
*/
// session_start();
include 'config.php';
global $options;

$c_name = str_replace('"', "'", $_POST['c_name']);
$inn = $_POST['inn'];
$c_profile = str_replace('"', "'", $_POST['c_profile']);
$director = $_POST['director'];
$c_address = str_replace('"', "'", $_POST['c_address']);
$phone = $_POST['phone'];

// добавление новой компании в базу
$sql = 'INSERT INTO '.$options["db_t_comp"].' (c_name, inn, c_profile, director, c_address, tel)
	VALUES ( "'.$c_name.'" ,"' .$inn.'" ,"' .$c_profile.'" ,"'.$director.'","'.$c_address.'","'.$phone.'")';
	
  // если новая запись внесена присваиваем номер записи переменной и считаем кол-во записей в теме
	if (mysqli_query($link, $sql) === TRUE) {
    // echo("Запись внесена");
  } else {
    echo("Запись не внесена");
    echo ("Error: " . $sql . "<br>" . $link_error);
  }
  
  mysqli_close($link);
  header("location: /index.php");

