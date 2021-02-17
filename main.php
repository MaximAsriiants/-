<div class="content">
  <div id='main_content' class="row p-0">
    <div class="col-3 pr-0 left-cat">
      <div class='p-3 left-top-cat w-100'><h2>КАТЕГОРИИ</h2></div>
      <div class='ml-2 mt-3'>
      <form method='post'>
      <?
        $query ="SELECT * FROM categories ORDER BY id";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        $rows = mysqli_num_rows($result);
        for ($i = 0 ; $i < $rows ; ++$i)
        {
          $row = mysqli_fetch_row($result);
          echo "<div class='text-center pt-2 d-inline-block sel_cat m-1 cat-button m-1' value='".mb_strtoupper($row[1])."' type='submit' name ='".$row[0]."'>
          <img src='/src/icons/".$row[0].".png'>
          <p>".$row[1]."</p>
          </div>";
        }
      ?>
      </form>
      </div>
    </div>
    <div id='categories' class="col-9 p-0 right-cat">
      <div class='w-100 p-3 pr-5 right-top-cat'><h2 style='text-align:right'>ВСЕ ТОВАРЫ</h2></div>
      <div class='items p-3'>
      <? 
        $query ="SELECT * FROM all_part ORDER BY RAND()";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        $rows = mysqli_num_rows($result);
        if ($rows == 0){
          echo "<div style='padding:250px' class='text-center'><h4>Что-то пошло не так, обновите страницу и попробуйте ещё раз!</h4><img src='/src/icons/load.gif' width='75px'></div>";
        }
          for ($i = 0 ; $i < $rows ; ++$i)
          {
            $row = mysqli_fetch_row($result);
            switch ($row[2]) {
              case 'Процессоры':
                $db = 'cpu';
                break;
              case 'Мат. Платы':
                $db = 'mb';
                break;
              case 'ОЗУ':
                $db = 'ram';
                break;
              case 'Видеокарты':
                $db = 'gpu';
                break;
              case 'Блоки Питания':
                $db = 'psu';
                break;
              case 'HDD':
                $db = 'hdd';
                break;
              case 'SSD':
                $db = 'ssd';
                break;
              case 'Охлаждение':
                $db = 'cooling';
                break;
              case 'Корпусы':
                $db = 'cases';
                break;
            }

          $query1 ="SELECT * FROM ".$db." WHERE article = '".$row[1]."'";
          $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
          $rows1 = mysqli_num_rows($result1);
          $row1 = mysqli_fetch_row($result1);
          echo "
          <button value='".$row[1]."' class='sel_item' type='submit'>
            <div class='part_block'>
              <p>".$row1[1]."</p>
              <img style='width:80px; height:80px;' src='/src/catalog/".$row1[9]."_1.jpg'>
              <p>Цена: ".$row1[2]."р.</p>
            </div>
          </button>
          ";
        }
        echo "</div>";
        ?>
      </div>
    </div>
  </div>

  <div id='register_content' style='display:none;' class='px-5 py-5 center'>
    <button id='goto-catalog' class="position-absolute btn btn-success mt-2"><- Вернуться к каталогу</button>
    <form id='register_form' action="post" class="w-25 m-auto p-3 form-horizontal text-center">
      <h4>Регистрация</h4>
      <input type="text" placeholder="Логин" name="usrname" class="mt-2 form-control"/>
      <input type="password" placeholder="Пароль" name="passwd" class="mt-2 form-control"/>
      <input type="text" placeholder="Имя" name="fname" class="mt-2 form-control"/>
      <input type="text" placeholder="Фамилия" name="lname" class="mt-2 form-control"/>
      <input type="text" placeholder="Отчество" name="mname" class="mt-2 form-control"/>
      <input type="text" placeholder="Эл.почта" name="mail" class="mt-2 form-control"/>
      <button type="submit" class="btn btn-success mt-2 w-100">Зарегистрироваться</button>
    </form>
    <div class='w-50 m-auto text-center'>
      <p class='d-none' style='color:red' id='register_status'></p>
    </div>
  </div>
</div>



<script>
  $(document).ready(function() { 

    $('.sel_cat').click(function(){
      var db = $(this).text().replace(/\s+/g, ' ').trim();
      localStorage.removeItem('item_article');
      localStorage.setItem('page', db);
      $('.sel_cat').removeClass('active_cat');
      $(this).addClass('active_cat');
        $.ajax({
          url:"take-cat-items.php",
          type: "POST",
          data: {'db' : db},
          dataType: 'html',
          beforeSend: function() { $('#content').html("<div style='padding:250px' class='text-center'><h4>Подождите...</h4><img src='/src/icons/load.gif' width='75px'></div>"); },
          success: function(response){ 
            if(response){
                $('#categories').html(response); 
              }
          }
        })
      event.preventDefault();
    });

    $('#register_user').click(function(){
      localStorage.setItem('page','register_page');
      localStorage.removeItem('item_article');
      $('#main_content').fadeOut();
      $('.dropdown-menu').removeClass('show');
      $('#register_content').fadeIn();
    });


    $('#goto-catalog').click(function(){
      $('#register_content').fadeOut();
      localStorage.setItem('page','main_page');
      localStorage.removeItem('item_article');
      $('#main_content').fadeIn();
    });

    $('#register_form').submit(function(e) {
      var errors = false;
      $(this).find('input').empty();
      $(this).find('input, textarea').each(function(){
        if( $.trim( $(this).val() ) == '' ) {
          errors = true;
          $(this).css('border','1px solid red');
          $('#register_status').removeClass('d-none');
          $('#register_status').html('Заполните поля помеченные красным!');
        } else {
          $(this).css('border','1px solid #ced4da');
          $('#register_status').addClass('d-none');
        }
      });

      if (!errors){ 
        $.ajax({
          url: 'user-register.php',
          type: 'POST',
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() { $('#status').html("<div style='padding:250px' class='text-center'><h4>Подождите...</h4><img src='/src/icons/load.gif' width='75px'></div>"); },
          success: function(res){
            if(res){
              res = JSON.parse(JSON.stringify(res));
              if(res.error){
                $('#register_status').removeClass('d-none');
                $('#register_status').html('При регистрации произошла ошибка: <br>' + res.error);
              } else {
                $('#register_status').removeClass('d-none');
                $('#register_status').css('color','black');
                $('#register_status').html(res.name + ', вы успешно зарегистрировались, теперь можете войти через меню "Войти" сверху страницы!');
                $('#register_form').fadeOut();
              }
            }
          }
        });
      }
        
      return false;
    });

    $('.sel_item').click(function(){
      var item = $(this).val();
      var item_cat = item.split('_')[0];
      $.ajax({
        url:"open-item.php",
        type: "POST",
        data: {'item' : item, 'item_cat' : item_cat},
        dataType: 'html',
        beforeSend: function() { $('#categories').html("<div style='padding:250px' class='text-center'><h4>Подождите...</h4><img src='/src/icons/load.gif' width='75px'></div>"); },
        success: function(response){ 
          if(response){
            $('#categories').html(response); 
            localStorage.setItem('page',item_cat);
            localStorage.setItem('item_article',item);
          }
        }
      })
    event.preventDefault();
  });
});
</script>