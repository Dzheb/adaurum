<?php
  /*
*  global setup
*/
session_start();
include 'config.php';
global $options;

$pswd = substr(crypt ($_POST['pswd'],'$5$adaurumtestcasetrial$') ,20);
$login = str_replace('"', "'", $_POST['login']);
// проверка на дублирование пользователя
// поиск клиента по логину и паролю
$sql='SELECT * FROM '.$options['db_t_users'].' WHERE login = "'.$login.'" AND pswd = "'.$pswd.'"';
$result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0) {
  // если клиент найден 
  $row = mysqli_fetch_assoc($result);
    $_SESSION["user_name"] = $row["username"];
    $_SESSION["user_id"] = $row["uid"];
    $_SESSION["auth_ok"] = "true";
    $_SESSION["auth_err"] = "авторизация успешна";
    
    mysqli_free_result($result);
    mysqli_close($link);
    header("location: /index.php");
    }
    else {
      $_SESSION["auth_err"] = "неправильный логин или пароль";

    }
    	
mysqli_close($link);
header("location: /index.php");
?>

