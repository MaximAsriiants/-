<?
	include 'connect/connect.php';

	$db=$_POST['db'];

	$db = mb_strtolower($db);

	switch ($db) {
	    case 'процессоры':
	      $table = 'cpu';
	      break;
	    case 'мат. платы':
	      $table = 'mb';
	      break;
	    case 'озу':
	      $table = 'ram';
	      break;
	    case 'видеокарты':
	      $table = 'gpu';
	      break;
	    case 'блоки питания':
	      $table = 'psu';
	      break;
	    case 'hdd':
	      $table = 'hdd';
	      break;
	    case 'ssd':
	      $table = 'ssd';
	      break;
	    case 'охлаждение':
	      $table = 'cooling';
	      break;
	    case 'корпусы':
	      $table = 'cases';
	      break;
	    default:
	  	  $table = $db;
	  	  break;
	  }

	echo "<div class='w-100 p-3 pr-5 right-top-cat'><h2 style='text-align:right'>".mb_strtoupper($db)."</h2></div><div class='items p-3'>";
	$query = "SELECT * FROM ".$table;
	$result = mysqli_query($link, $query) or die("<div style='padding:250px' class='text-center'><h4>Что-то пошло не так, обновите страницу и попробуйте ещё раз!</h4><img src='/src/icons/load.gif' width='75px'></div>"); 
	$rows = mysqli_num_rows($result);
	if ($rows == 0){
		die("<div style='padding:250px' class='text-center'><h4>Что-то пошло не так, обновите страницу и попробуйте ещё раз!</h4><img src='/src/icons/load.gif' width='75px'></div>");
	} else {
		for ($i = 0 ; $i < $rows ; ++$i)
		{
	      $row = mysqli_fetch_row($result);
	      echo "
	      <button class='sel_item catalog_item' value='".$row[9]."' type='submit'>
	        <div class='part_block'>
	          <p>".$row[1]."</p>
	          <img style='width:75px' src='/src/catalog/".$row[9]."_1.jpg'>
	          <p>Цена: ".$row[2]."р.</p>
	        </div>
	      </button>
	      ";
	      echo"</div>";
		}
	}
	echo "</div>";
?>
<script>
$(document).ready(function() {
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