<? session_start(); 
include 'connect/connect.php'; 
$_SESSION['page']='main'?>
<html>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/css/bootstrap.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/navbar.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/cat.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/11528.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/8483.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/stylesheet.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/owl.carousel.min.css" crossorigin="anonymous">
  </head>
  <body>
    <script src="/js/jquery-3.5.1.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <?include 'modules/navbar.php';?>
    <?include 'main.php';
      include 'modules/user-profile.php';
      include 'modules/cart.php';?>
      
  </body>
</html>
<script type="text/javascript">
$(document).ready(function() {
  var username = '<? echo $_SESSION["username"]; ?>';
}); 
</script>
<script type="text/javascript">
$(document).ready(function() {
  if (localStorage.getItem('page')){
    var page = localStorage.getItem('page').split('_')[0];
    switch(page) {
      case 'main': 
        $('#register_content').hide('fast');
        $('#cart_content').hide('fast');
        $('#profile_content').hide('fast');
        $('#main_content').show('fast');
        break;

      case 'register': 
        $('#register_content').show('fast');
        $('#cart_content').hide('fast');
        $('#profile_content').hide('fast');
        $('#main_content').hide('fast');
        break;

      case 'cart': 
        $('#register_content').hide('fast');
        $('#cart_content').show('fast');
        $('#profile_content').hide('fast');
        $('#main_content').hide('fast');
        break;

      case 'profile': 
        $('#register_content').hide('fast');
        $('#cart_content').hide('fast');
        $('#profile_content').show('fast');
        $('#main_content').hide('fast');
        break;

      case 'CPU':
      case 'MB':
        if (localStorage.getItem('item_article')){
          var item = localStorage.getItem('item_article');
          var item_cat = page;
          $.ajax({
            url:"open-item.php",
            type: "POST",
            data: {'item' : item, 'item_cat' : item_cat},
            dataType: 'html',
            beforeSend: function() { $('#categories').html("<div style='padding:250px' class='text-center'><h4>Подождите...</h4><img src='/src/icons/load.gif' width='75px'></div>"); },
            success: function(response){ 
              if(response){
                $('#categories').html(response); 
                switch (item_cat){
                  case 'CPU':
                  $('div[value="ПРОЦЕССОРЫ"]').addClass('active_cat');
                  break; 
                  case 'MB':
                  $('div[value="МАТ. ПЛАТЫ"]').addClass('active_cat');
                  break; 
                }
              }
            }
          });
        } else {
          var db = page.toLowerCase();
          $.ajax({
            url:"take-cat-items.php",
            type: "POST",
            data: {'db' : db},
            dataType: 'html',
            beforeSend: function() { $('#content').html("<div style='padding:250px' class='text-center'><h4>Подождите...</h4><img src='/src/icons/load.gif' width='75px'></div>"); },
            success: function(response){ 
              if(response){
                  $('#categories').html(response); 
                  switch (db){
                    case 'cpu':
                    $('div[value="ПРОЦЕССОРЫ"]').addClass('active_cat');
                    break; 

                    case 'mb':
                    $('div[value="МАТ. ПЛАТЫ"]').addClass('active_cat');
                    break; 
                  }
                }
            }
          })
        }
        break;

      default:
        break;
    } 
  } else {
    localStorage.setItem('page','main_page');
  }
}); 
</script>