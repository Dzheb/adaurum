<?php
  /*
  *  global setup
  */
  // 
  session_start();
  include 'config.php';
  global $options;

  $c_name = $_GET["q"];
  $_SESSION["cid_str"] = $c_name;
  if ($_SESSION["field_name"] == ''){
      $_SESSION["field_name"] = "c_name";
      $_SESSION["field_name_str"] = "О компании";
  }
  $sql='SELECT * FROM '.$options['db_t_comp'].' WHERE c_name = "'.$c_name.'"';
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $cid = $row["cid"];
    $_SESSION["cid"] = $cid;
    } else {
    //  echo "0 записей";
  }
  mysqli_free_result($result);
  
  $sql='SELECT * FROM '.$options['db_t_comnts'].' WHERE cid = "'.$cid.'" AND uid = "'. $_SESSION['user_id'].'" AND f_name = "'.  $_SESSION['field_name'].'"';
  $result = mysqli_query($link, $sql);
  echo('<div class="dropdown">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
    Название поля для комментария</button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" id="com_com" onclick="f_name(this)" href="#">О компании</a></li>
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
        <th>Комментарии от: '. $_SESSION["user_name"].'</th>
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
// else {
//     echo "0 записей";
// }
mysqli_close($link);

?>