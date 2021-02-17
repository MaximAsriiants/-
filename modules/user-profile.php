<div id='profile_content' style='display:none;' class='px-5 py-5 center w-100'>
  <button id='goto-catalog1' class="position-absolute btn btn-success mt-2"><- Вернуться к каталогу</button>
  <div class='m-auto w-50'>
    <div class='w-25 h-25 m-auto text-center'>
      <h3><? echo mb_strtoupper($_SESSION['username']); ?></h3>
      <img style='border-radius: 50px' width='100' src='/src/avatars/avatar_<? echo $_SESSION['username']; ?>.png'>
    </div>
    <div class='w-50 m-auto text-center'>
      
      <?
      $query ="SELECT * FROM users WHERE username='".$_SESSION['username']."'";
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
      $rows = mysqli_num_rows($result);
      $row = mysqli_fetch_row($result);
      echo '
      <h3>Изменить пароль:</h3>
      <form id="user-data-password-form" action="post" class="p-3 form-horizontal text-center">
        <input type="password" placeholder="Введите новый пароль" name="pass1" class="mt-2 form-control"/>
        <input type="password" placeholder="Введите новый пароль ещё раз" name="pass2" class="mt-2 form-control"/>
        <button type="submit" class="btn btn-outline-success mt-2 w-100">Изменить пароль</button>
      </form>
      ';
      echo '
      <h3>Данные профиля:</h3>
      <form id="user_data_form" class="p-3 form-horizontal text-center">
        <input type="text" placeholder="Имя: '.$row[3].'" name="fname" class="mt-2 form-control"/>
        <input type="text" placeholder="Отчество: '.$row[5].'" name="lname" class="mt-2 form-control"/>
        <input type="text" placeholder="Фамилия: '.$row[4].'" name="mname" class="mt-2 form-control"/>
        <input type="text" placeholder="Адрес: '.$row[6].'" name="address" class="mt-2 form-control"/>
        <input type="text" placeholder="Телефон: '.$row[7].'" name="tel" class="mt-2 form-control"/>
        <input type="text" placeholder="Почта: '.$row[8].'" name="mail" class="mt-2 form-control"/>
        <button type="submit" class="btn btn-outline-success mt-2 w-100">Изменить данные</button>
      </form>
      ';?>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#profile_settings').click(function(){
    $('#main_content').fadeOut();
    localStorage.setItem('page','profile_page');
    localStorage.removeItem('item_article');
    $('#profile_content').fadeIn();
  });

  $('#goto-catalog1').click(function(){
    $('#profile_content').fadeOut();
    localStorage.setItem('page','main_page');
    $('#main_content').fadeIn();
  });

  $('#user_data_form').submit(function(e) { 
    var username = '<? echo $_SESSION["username"] ?>'
    data = $(this).serialize() + '&username='+username;
    $.ajax({
      url: 'change-profile.php',
      type: 'POST',
      data: data,
      dataType: 'json',
      beforeSend: function() { $('#status').html('Обождите...'); },
      success: function(res){
        if(res){
          res = JSON.parse(JSON.stringify(res));
          if(res.error){
            alert(res.error);
          } else {
            alert(res.success);
          }
        }
      }
    });
    return false;
  });
}); 
</script>