<?php
  /*
*  global setup
*/
session_start();
include 'config.php';
global $options;


$pswd = substr(crypt ($_POST['pswd'],'$5$adaurumtestcasetrial$') ,20);
$login = str_replace('"', "'", $_POST['login']);
$user_name = str_replace('"', "'", $_POST['user_name']);
// проверка на дублирование пользователя
// поиск клиента по логину и паролю
$sql='SELECT * FROM '.$options['db_t_users'].' WHERE login = "'.$login.'"';
$result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0) {
  // если клиент найден сообщение о том что клиент уже существует
  // $row = mysqli_fetch_assoc($result);
    $_SESSION['auth_err'] = "клиент с таким логин существует";
    mysqli_free_result($result);
    mysqli_close($link);
    header("location: /index.php");
    }
    	
   
// добавление новой компании в базу
$sql = 'INSERT INTO '.$options["db_t_users"].' (username, pswd, login)
VALUES ( "'.$user_name.'" ,"' .$pswd.'" ,"' .$login.'")';

// если новая запись внесена присваиваем номер записи переменной и считаем кол-во записей в теме
if (mysqli_query($link, $sql) === TRUE) {
  // echo("Запись внесена");
} else {
  echo("Запись не внесена");
  echo ("Error: " . $sql . "<br>" . $link_error);
}

mysqli_close($link);
header("location: /index.php");
?>

