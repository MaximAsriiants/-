<div style='display: none;' id='cart_content' class='w-100 p-5'>
  <button id='goto-catalog2' class="position-absolute btn btn-success mt-2"><- Вернуться к каталогу</button>
  <div class='w-75 pt-5 m-auto'>
    <div id='items-main' class='<?
    $query ="SELECT * FROM users WHERE username='".$_SESSION['username']."'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    $rows = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);
    $query1 ="SELECT * FROM cart WHERE user_id='".$row[0]."'";
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
    $rows1 = mysqli_num_rows($result1);
    if ($rows1 <= 0){
      echo 'd-none';
    }
    ?>
    row cart-items w-100 text-center'>
      <div class='col'>
        <h4>Наименование</h4>
      </div>
      <div class='col'>
        <h4>Количество</h4>
      </div>
      <div class='col'>
        <h4>Цена</h4>
      </div>
      <div class='col-1'>
      </div>
      <div class='w-100'></div>
        <?
          $query ="SELECT * FROM users WHERE username='".$_SESSION['username']."'";
          $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
          $rows = mysqli_num_rows($result);
          $row = mysqli_fetch_row($result);
          $query1 ="SELECT * FROM cart WHERE user_id='".$row[0]."'";
          $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
          $rows1 = mysqli_num_rows($result1);
          for ($i = 0 ; $i < $rows1 ; ++$i)
          {
            $row1 = mysqli_fetch_row($result1);
            $table = mb_strstr($row1[1],"_",true);
            $query2 ="SELECT * FROM $table WHERE article='".$row1[1]."'";
            $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
            $row2 = mysqli_fetch_row($result2);
            $price= $row1[2] * $row2[2];
            echo"<div id='cart-item' class='w-100 p-3 text-center row'><div class='col'><h5>".$row2[1]."</h5></div>
            <div class='col'><h5>".$row1[2]."</h5></div>
            <div class='col'><h5>".$price."</h5></div>
            <div class='col-1'><a href='#' class='delete-item' value='".$row1[1]."'>Удалить</a></div>
            <div class='w-100'></div></div>";
          }
          $_SESSION['user_id'] = $row[0];
          echo "<div class='col text-right p-2'>
            <button class='btn btn-success' id='make-offer'>Оформить заказ</button>
          </div>";
        ?>
    </div>
  </div>
  <div id='cart-empty' <?
    $query ="SELECT * FROM users WHERE username='".$_SESSION['username']."'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    $rows = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);
    $query1 ="SELECT * FROM cart WHERE user_id='".$row[0]."'";
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
    $rows1 = mysqli_num_rows($result1);
    if (!($rows1 <= 0)){
      echo 'style="display:none;"';
    } else { }
    ?> class='w-100 text-center'>
    <h4>Ваша корзина пуста:(</h4>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.delete-item').click(function(){
      var article = $(this).attr('value');
      $(this).parent().parent().hide('slow', function(){ $(this).remove(); });
      setTimeout(checkCart, 1000);
      var user_id = "<? echo $_SESSION['user_id']; ?>";
      $.ajax({
        url: '/modules/delete-cart-item.php',
        type: 'POST',
        data: {'article' : article, 'user_id' : user_id},
        dataType: 'json',
        beforeSend: function() { $('#status').html('Обождите...'); },
        success: function(res){
          if(res){
            res = JSON.parse(JSON.stringify(res));
            
          }
        }
      });
    });

    function checkCart(){
      if (!document.getElementById('cart-item')) {
        $('.cart-items').hide('fast');
        $('#cart-empty').show('fast');
      }
    }

    $('#user_cart').click(function(){
      $('#main_content').fadeOut();
      localStorage.setItem('page','cart_page');
      localStorage.removeItem('item_article');
      $('#cart_content').fadeIn();
    });

     $('#user_cart').click(function(){
        $('#profile_content').fadeOut();
        $('#register_content').fadeOut();
        $('#main_content').fadeOut();
        $('#cart_content').fadeIn();
      });

    $('#goto-catalog2').click(function(){
      $('#cart_content').fadeOut();
      localStorage.setItem('page','main_page');
      localStorage.removeItem('item_article');
      $('#main_content').fadeIn();
    });  
  });
</script>