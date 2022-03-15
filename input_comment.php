<?php
 // global setup
 session_start();
  include 'config.php';
  global $options;

  $comment = $_GET["q"];
  $com_date = date('Y-m-d H:i:s');
 
//
// добавление новой компании в базу
$sql = 'INSERT INTO '.$options["db_t_comnts"].' (cid, uid, date_com, comment, f_name)
	VALUES ( "'.$_SESSION["cid"].'" ,"' .$_SESSION["user_id"].'" ,"' .$com_date.'" ,"'.$comment.'","'.$_SESSION["field_name"].'")';

  if (mysqli_query($link, $sql) === TRUE) {

  // если новая запись внесена присваиваем номер записи переменной и считаем кол-во записей в теме
  $sql='SELECT * FROM '.$options['db_t_comnts'].' WHERE cid = "'.$_SESSION['cid'].'" AND uid = "'.$_SESSION['user_id'].'"';
  $result = mysqli_query($link, $sql);
    // if (mysqli_num_rows($result) > 0) {
    // echo("Запись внесена");
    
    echo('<div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
    Название поля для комментария</button>
    <ul class="dropdown-menu">
    <li><a class="dropdown-item" id="com_com" onclick="f_name(this)" href="#">В целом о компании</a></li>
    <li><a class="dropdown-item" id="com_pro" onclick="f_name(this)" href="#">Вид деятельности</a></li>
    <li><a class="dropdown-item" id="com_inn" onclick="f_name(this)" href="#">ИНН</a></li>
    <li><a class="dropdown-item" id="com_adr" onclick="f_name(this)" href="#">Адрес</a></li>
    <li><a class="dropdown-item" id="com_dir" onclick="f_name(this)" href="#">Директор</a></li>
    <li><a class="dropdown-item" id="com_tel" onclick="f_name(this)" href="#">Телефон</a></li>
    </ul>
    </div>');
    
    echo('<div class="mb-3 mt-3">
    <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
    </div>
    <button  class="btn btn-primary" onclick="input_comment()">Отправить</button>');
    
    
    if (mysqli_num_rows($result) > 0) {
      echo('<table class="table table-striped table-responsive">
      <thead>
      <tr>
      <th>Комментарии '.$_SESSION["user_name"].' о '.$_SESSION['field_name'].'</th>
      <th>Время комментария</th>
      </tr>
      </thead>
      <tbody id = "table_comment">');
      while($row = mysqli_fetch_assoc($result)) {
        
        // вывод данных каждой строки
        
        $f_time = date("Y-m-d H:i:s",strtotime($row["date_com"]));
        echo('<tr>
        <td>'.$row["comment"].'</td>
        <td>'. $f_time.'</td>
        </tr>');
      }
      echo('</tbody>
      </table>');
      mysqli_free_result($result);
    } 
    
    
  } 
    else {
    echo("Запись не внесена");
    echo ("Error: " . $sql . "<br>" . $link_error);
  }
  
  mysqli_close($link);
  
  ?>
 