<nav class="navbar navbar-expand-lg navbar-dark bg-custom"><a id='open_main_page' href="#" class="navbar-brand">
  <img style='width:50px' src='/src/icons/logo.png'>
  </a>
  <button type="button" data-toggle="collapse" data-target="#navbar5" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
  <div id="navbar5" class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a href="#" class="nav-link">Покупателям</a></li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input type="search" placeholder="Поиск..." aria-label="Поиск..." class="form-control mr-sm-2"/>
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">НАЙТИ</button>
    </form>
    <ul class="navbar-nav">
    <li class="nav-item dropdown"><a id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><? if (empty($_SESSION['username'])){ echo 'Войти'; } else { echo 'Кабинет'; } ?></a>
      <div aria-labeledby="navbarDropdown" style="margin-left:-175px;" class="dropdown-menu">
        <? if (empty($_SESSION['username'])){ echo '
        <form  id="login-form" action="post" class="p-3 form-horizontal text-center">
          <h4>Войти в лк</h4>
          <input type="text" placeholder="Логин" name="usrname" class="form-control"/>
          <input type="password" placeholder="Пароль" name="passwd" class="mt-2 form-control"/>
          <p id="login-status" class="p-0" style="display:none; color:red;"></p>
          <button type="submit" class="btn btn-success mt-2 w-100">Войти</button>
          <button id="register_user" type="submit" name="reg" class="btn btn-outline-primary mt-2 w-100">Регистрация</button>
        </form>';}
        else { echo '
        <form action="logout.php" id="logged-form" class="p-3 form-horizontal text-center">
          <h4 id="status">Добро пожаловать,'.$_SESSION['username'].'</h4>
          <a href="#" id="profile_settings" class="mt-2 w-100 btn btn-outline-info">Личный кабинет</a>
          <a href="#" id="user_cart" class="mt-2 w-100 btn btn-outline-primary">Корзина</a>
          <button type="submit" class="btn btn-outline-danger mt-2 w-100">Выйти</button>
        </form>';
      }
      ?>
      </div>
    </li>
  </ul>
  </div>
</nav>
    <script>
      $(document).ready(function() {

        $('#open_main_page').click(function(){
          $('#register_content').fadeOut();
          $('#profile_content').fadeOut();
          $('#cart_content').fadeOut();
          $('#main_content').fadeIn();
          localStorage.setItem('page','main_page');
          localStorage.removeItem('item_article');
        });

        $('#login-form').submit(function(e) {
            var errors = false;
          $('#login-status').hide('fast');
          $(this).find('input').empty();
          $(this).find('input, textarea').each(function(){
            if( $.trim( $(this).val() ) == '' ) {
              errors = true;
              $(this).css('border','1px solid red');
              $('#login-status').show('fast');
              $('#login-status').css('color','red');
              $('#login-status').html('Вы не ввели логин/пароль.');
            } else {
              $(this).css('border','1px solid #ced4da');
            }
          });
  
          if (!errors){ 
            $.ajax({
              url: 'login.php',
              type: 'POST',
              data: $(this).serialize(),
              dataType: 'json',
              beforeSend: function() { $('#status').html('Обождите...'); },
              success: function(res){
                if(res){
                	res = JSON.parse(JSON.stringify(res));
                  if(res.error){
                    $('#login-status').show('fast');
                    $('#login-status').html(res.error);
                  } else {
                    location.reload();
                  }
                }
              }
            });
          }
            
          return false;
        });
      });
    </script>