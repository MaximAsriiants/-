<?
	include 'connect/connect.php';

	$item=$_POST['item'];
  $item_cat=$_POST['item_cat'];

  switch ($item_cat) {
    case 'MB':
      $field1 = 'Сокет';
      $field2 = 'Чипсет';
      $field3 = 'Тип памяти';
      $field4 = 'Частота памяти';
      $field5 = 'Количество модулей';
      $field6 = 'Макс. объем памяти';
      break;
    case 'CPU':
      $table = 'CPU';
      break;
  }

	$query = "SELECT * FROM $item_cat WHERE article='$item'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
  $row = mysqli_fetch_row($result);
  $query1 = "SELECT * FROM descriptions WHERE article='$item'";
  $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
  $row1 = mysqli_fetch_row($result1);
  echo "
  <div class='text-center content'>
    <h1>".mb_strtoupper($row[1])."</h1>
    <div class='owl-carousel text-center'>
      <div class='p-5'><img style='width:200px' src='/src/catalog/".$row[9]."_1.jpg'></div>
      <div class='p-5'><img style='width:200px' src='/src/catalog/".$row[9]."_2.jpg'></div>
      <div class='p-5'><img style='width:200px' src='/src/catalog/".$row[9]."_3.jpg'></div>
    </div>
    <div class='p-4 w-100 text-left'>
      <h2>Характеристики:</h2>
      <div class='row'>
        <div class='col'>
          <h4>
          <b>".$field1.":</b> ".$row[3]."<br>
          <b>".$field2.":</b> ".$row[4]."<br>
          <b>".$field3.":</b> ".$row[5]."<br>
          </h4>
        </div>
        <div class='col'>
          <h4>
          <b>".$field4.":</b> ".$row[6]."<br>
          <b>".$field5.":</b> ".$row[7]."<br>
          <b>".$field6.":</b> ".$row[8]."<br>
          </h4>
        </div>
        <div class='col'>
          <h4>
          <b>Цена:</b> $row[2]р.
          </h4>
          <div class='input-group w-75'>
            <select class='custom-select' id='inputGroupSelect04'>
              <option value='1' selected>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
              <option value='6'>6</option>
              <option value='7'>7</option>
              <option value='8'>8</option>
              <option value='9'>9</option>
              <option value='10'>10</option>
            </select>
            <div class='input-group-append'>
              <button class='btn add-to-cart btn-outline-success' type='button'>Добавить</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class='p-4 w-100 text-left'>
    <h2>Описание товара:</h2>
    <h5 class=''>".$row1[2]."</h5>
    </div>
  </div>";
?>

<script type="text/javascript">
  $(document).ready(function(){
    $('.add-to-cart').click(function(){
      
    });

    $(".owl-carousel").owlCarousel({
      center: true,
      items:3,
      loop:true,
      margin:10,
    });
  });
</script>