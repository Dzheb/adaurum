<?php
setlocale (LC_ALL, 'nl_NL'); // Преобразуем каракули в кириллицу

/*
*  global setup
*/

$options = array(
  /* Настройки подключения к БД */
  'db_server'     => 'localhost', // Сервер БД
  'db_user'       => 'root', // Имя пользователя
  'db_password'   => 'root', // Пароль
  'db_base'       => 'adaurum', // Имя базы данных
  'db_t_comp'     => 'companies',
  'db_t_comnts'   => 'comments',
  'db_t_users'    =>  'users'
);
  
/*
*  Подключаемся к Базе Данных
*/
$link = mysqli_connect($options['db_server'], $options['db_user'], $options['db_password'],$options['db_base']);
// 
if (!$link) {
  die('Ошибка соединения: ' . mysqli_connect_error());
}

//общаемся с БД только в UTF-8
 
mysqli_query($link,"SET NAMES 'utf8'");
mysqli_query($link,"SET CHARACTER SET 'utf8'");
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci'");

?>