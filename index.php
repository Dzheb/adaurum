<?php
  /*
  *  global setup
  */
  // 
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AdAurum test</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      />
      <link rel="stylesheet" href="css/style.css"/> 
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
   
  </head>
  
  <body>
    <div class="row">
      <div class="col-sm-3 p-3 text-center small"id = "hello"><?php $_SESSION['auth_err'] ;?></div>
      <div class="col-sm-2 p-3"><h2>AdAurum</h2></div>
      <div class="col-sm-3 p-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rec_comp">Добавить компанию</button>
      </div>
      <div class="col-sm-4 p-3">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rec_reg">
          Регистрация</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rec_ent">
            Вход</button>
          <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logout.php">
            Выход</button> -->
          <a href="logout.php" type="button" class="btn btn-primary" role="button" aria-pressed="true">Выход</a>
        </div>
      </div>
    <!-- </div> -->

        
        <div class="container">
          <p>Список компаний для тестового задания (кликните наименование компании для просмотра комментариев):</p>
        </div>
        
        <div class="row">
<?php
  /*
  *  global setup
  */
  // 
  session_start();
  include 'config.php';
  global $options;
  if ($_SESSION["field_name"] == '') {
    $_SESSION["field_name_str"] = "О компании";
    $_SESSION['field_name'] = "c_name";
  }

  $sql = "SELECT cid, c_name, inn, c_profile, director, c_address, tel FROM ".$options['db_t_comp'];
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) > 0) {
    // вывод данных каждой строки
 
    while($row = mysqli_fetch_assoc($result)) {
     echo('<div class="col-sm-2 mx-auto p-3"><div id = '.$row["cid"].' onclick = "point_comp(this)" style="cursor: pointer";>'.$row["c_name"].'</div><p style="font-size: small";>'. $row["c_profile"].'</br>'.$row["c_address"].'</br>'. $row["tel"].'</br>'.'</p>'.'</div>');
   
    }
    mysqli_free_result($result);
}
//  else {
//     echo "0 записей";
// }
mysqli_close($link);

// 
// начало сессии
// проверка правильности входа
	 if(isset($_SESSION["auth_ok"]) ) {
		if($_SESSION["auth_ok"] != "true") {
      $_SESSION["auth_err"] = "Необходима авторизация";
			}
 		
		} else {
      $_SESSION["auth_err"] = "Необходима авторизация";
			}
?>

</div>
<!--  -->
<div class="row">
  <div class="col-sm-2 p-3" style="text-align:center;"></div>
  <div class="col-sm-6 p-3" id = "header_comp" style="text-align:center;"></div>
  <div class="col-sm-4 p-3" style="text-align:center;"></div>
</div>

<!-- Модал компании -->
  <div class="modal" id="rec_comp" data-backdrop="false">
    <div class="modal-dialog modal-md modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!--  -->
        <!-- Modal body -->
        <div class="modal-body">
           <!-- форма ввода компании -->
            <form  method="POST" action="send_comp.php" class="p-2 grey-text">
            <!-- имя компании -->
            <div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
              <label for="c_name">Компания:</label>
               <input type="text" id="c_name" class="form-control form-control-sm  required" name="c_name">
            </div>
           <!-- ИНН -->
            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
             <label for="inn">ИНН(10 цифр):</label>
              <input type="text" id="inn" maxlength="10" class="form-control form-control-sm required" name="inn">
            </div>
           <!-- Телефон -->
            <div class="md-form form-sm"> <i class="fa fa-phone prefix"></i>
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" class="form-control form-control-sm  required" name="phone">
            <small>Формат: +7(999)999-99-99</small><br>
           </div>
           <!-- Описание деятельности компании -->
           <div class="md-form form-sm"> <i class="fa fa-tag prefix"></i>
            <label for="c_profile">Описание деятельности:</label>
             <input type="text"  id="c_profile" class="form-control form-control-sm required" name="c_profile" rows="4"></textarea">
          </div>
           <!--  -->
          <!-- Адрес компании -->
          <div class="md-form form-sm"> <i class="fa fa-tag prefix"></i>
           <label for="c_address">Адрес компании:</label>
           <input type="text"  id="c_address" class="form-control form-control-sm required" name="c_address" rows="4"></textarea">
         </div>
         <!--  -->
         <!-- имя руководителя -->
         <div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
          <label for="director">Руководитель:</label>
          <input type="text" id="director" class="form-control form-control-sm  required" name="director">
        </div>
        <!--  -->
        <div class="text-center my-2">
          <button class="btn btn-primary">Отправить<i class="fa fa-paper-plane-o ml-1"></i></button>
          <input type="reset">
        </div>
     </form>
     <!-- конец формы ввода компании -->
     </div>
  <!-- конец modal body -->

    </div> 
  </div>
</div>

<!--  -->

<!-- Модал Регистрация-->
<div class="modal" id="rec_reg" data-backdrop="false">
    <div class="modal-dialog modal-sm modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
        <h7 class="modal-title">Для регистрации введите</h7>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!--  -->
        <!-- Modal body -->
        <div class="modal-body">
           <!-- форма регистрации -->
            <form  method="POST" action="send_reg.php" class="p-2 grey-text">
            <!-- логин -->
            <div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
              <label for="login">Логин (не более 15):</label>
               <input type="text" id="login" maxlength="15" class="form-control form-control-sm  required" name="login">
            </div>
           <!-- пароль -->
            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
             <label for="pswd">Пароль (10 цифр):</label>
              <input type="password" id="pswd" maxlength="10" class="form-control form-control-sm required" name="pswd">
            </div>
           
         <!-- имя пользователя -->
         <div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
          <label for="user_name">Ф.И.О.:</label>
          <input type="text" id="user_name" maxlength="30" class="form-control form-control-sm  required" name="user_name">
        </div>
        <!--  -->
        <div class="text-center my-2">
          <button class="btn btn-primary">Отправить<i class="fa fa-paper-plane-o ml-1"></i></button>
          <input type="reset">
        </div>
    </form>
     <!-- конец формы регистрации -->
     </div>
  <!-- конец modal body -->

    </div> 
  </div>
</div>
<!-- конец modal -->


<!-- Модал Вход-->
<div class="modal" id="rec_ent" data-backdrop="false">
    <div class="modal-dialog modal-sm modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
        <h7 class="modal-title">Для входа введите</h7>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!--  -->
        <!-- Modal body -->
        <div class="modal-body">
           <!-- форма входа -->
            <form  method="POST" action="send_ent.php" class="p-2 grey-text">
            <!-- логин -->
            <div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
              <label for="login">Логин (не более 15):</label>
               <input type="text" id="login" maxlength="15" class="form-control form-control-sm  required" name="login">
            </div>
           <!-- пароль -->
            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
             <label for="pswd">Пароль (10 цифр):</label>
              <input type="password" id="pswd" maxlength="10" class="form-control form-control-sm required" name="pswd">
            </div>
 
         <div class="text-center my-2">
          <button class="btn btn-primary">Отправить<i class="fa fa-paper-plane-o ml-1"></i></button>
          <input type="reset">
        </div>
    </form>
     <!-- конец формы входа -->
     </div>
  <!-- конец modal body -->
</div> 
</div>
</div>
<!-- конец modal -->

<div class="row">
  <div class="col-sm-2 p-1" id = "close_comm" style="text-align:center;"></div>
  <div class="col-sm-6 p-1" id = "card_comm" style="text-align:center;"></div>
  <div class="col-sm-4 p-1" style="text-align:center;"></div>
</div>

<!-- <script src="myScript.js"></script> -->
<script>

  // функция записи комментария
function input_comment() {
  if (document.getElementById('comment').value === '') {
    return;
  }

  var str = document.getElementById('comment').value;
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('card_comm').innerHTML = this.responseText;
  };
  xhttp.open('GET', 'input_comment.php?q=' + str);
  xhttp.send();
}

// функция обработки выбора поля
function f_name(id) {
  var str = id.innerHTML;
  var comp_name = '<? echo($_SESSION["cid_str"]);?>';
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById('header_comp').innerHTML =
      '<p>Комментарии о компании: ' +
      comp_name +
      ' тема комметария: ' +
      this.responseText +
      '</p>';
    // document.getElementById("card_comm").innerHTML = this.responseText;
  };
  xhttp.open('GET', 'getfield.php?q=' + str);
  xhttp.send();
}
// функция обработки кнопки закрытия блока
function close_comm() {
  var x = document.getElementById('header_comp');
  var y = document.getElementById('close_comm');
  var z = document.getElementById('card_comm');

  if (x.style.display === 'block') {
    x.style.display = 'none';
    y.style.display = 'none';
    z.style.display = 'none';
  } else {
    x.style.display = 'none';
    y.style.display = 'none';
    z.style.display = 'none';
  }
}
// вывод инфо о компании
function point_comp(id) {
  var comp_name = id.innerText;
  var auth = '<?php echo $_SESSION["auth_ok"];?>';
  // проверка авторизации
  if (auth === 'true') {
    document.getElementById('close_comm').innerHTML =
      '<button type="button" class="btn btn-primary" onclick="close_comm()">Закрыть</button>';
    document.getElementById('header_comp').innerHTML =
      '<p>Комментарии о компании: ' +
      comp_name +
      ' тема комметария: ' +
      '<?php echo $_SESSION["field_name_str"];?>' +
      '</p>';
    document.getElementById('card_comm').innerHTML = '';
    var x = document.getElementById('header_comp');
    var y = document.getElementById('close_comm');
    var z = document.getElementById('card_comm');
    if (x.style.display === 'none') {
      x.style.display = 'block';
      y.style.display = 'block';
      z.style.display = 'block';
    }

    var str = id.innerHTML;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      document.getElementById('card_comm').innerHTML = this.responseText;
    };
    xhttp.open('GET', 'getcompany.php?q=' + str);
    xhttp.send();
  } else {
    document.getElementById('hello').innerText =
      '<?php echo $_SESSION["auth_err"];?>';
  }
}

</script>
  </body>
</html>
